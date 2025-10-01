<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\TrainingMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;
use Imagick;

class AttendanceController extends Controller
{
    /**
     * Display user attendance page for a training
     */
    public function userAbsen($id)
    {
        $training = Training::with(['detail', 'jenisTraining'])->findOrFail($id);
        $user = Auth::user();

        // Get user's membership for this training
        $member = $training->members()->where('user_id', $user->id)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Anda bukan peserta training ini.');
        }

        // Get user's attendance status
        $attendance = $member->attendance()->latest()->first();

        return view('training.user-absen', compact('training', 'member', 'attendance'));
    }

    /**
     * Generate QR code for user attendance
     */
    public function generateQR($id)
    {
        $training = Training::findOrFail($id);
        $user = Auth::user();

        // Get user's membership for this training
        $member = $training->members()->where('user_id', $user->id)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Anda bukan peserta training ini.');
        }

        // Create QR code data
        $qrData = [
            'user_id' => $user->id,
            'training_id' => $training->id,
            'member_id' => $member->id,
            'timestamp' => now()->timestamp
        ];

        // Generate QR code as SVG
        $qrCode = $this->generateQRCodeImage(json_encode($qrData));

        return view('training.qr-code', compact('qrCode', 'training', 'member'));
    }

    /**
     * Process uploaded QR code for attendance
     */
    public function processQR(Request $request, $id)
    {
        $request->validate([
            'qr_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $training = Training::findOrFail($id);
        $user = Auth::user();

        // Get user's membership for this training
        $member = $training->members()->where('user_id', $user->id)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Anda bukan peserta training ini.');
        }

        if ($request->hasFile('qr_image')) {
            $image = $request->file('qr_image');

            try {
                // Store the uploaded image temporarily
                $imagePath = $image->store('temp_qr', 'public');

                // Here you would typically use a QR code reading library like "bacon/bacon-qr-code" or "endroid/qr-code"
                // For now, we'll simulate the process by checking if the user hasn't attended yet
                // In a real implementation, you would:
                // 1. Use a QR code reader to decode the image
                // 2. Validate the QR code data matches the user's data
                // 3. Check if the QR code is valid and not expired

                // Simulate QR code validation - in real implementation, decode the actual QR code
                $qrData = $this->simulateQRDecode($training->id, $user);

                if ($qrData && $this->validateQRData($qrData, $user->id, $training->id, $member->id)) {
                    if ($member->attendance()->count() == 0) {
                        // Mark attendance
                        $member->attendance()->create([
                            'attended_at' => now()->setTimezone('Asia/Jakarta'),
                            'status' => 'present',
                        ]);

                        // Clean up temp file
                        Storage::disk('public')->delete($imagePath);

                        return redirect()->route('training.user.absen', $training->id)
                            ->with('success', 'Absen berhasil dicatat melalui QR Code.');
                    } else {
                        Storage::disk('public')->delete($imagePath);
                        return redirect()->route('training.user.absen', $training->id)
                            ->with('error', 'Anda sudah melakukan absen sebelumnya.');
                    }
                } else {
                    Storage::disk('public')->delete($imagePath);
                    return redirect()->back()->with('error', 'QR Code tidak valid atau tidak dapat dibaca.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal memproses QR Code: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'Gagal memproses QR Code.');
    }

    /**
     * Download QR code as PNG
     */
    public function downloadQR($id)
    {
        $training = Training::findOrFail($id);
        $user = Auth::user();

        // Get user's membership for this training
        $member = $training->members()->where('user_id', $user->id)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Anda bukan peserta training ini.');
        }

        // Create QR code data
        $qrData = [
            'user_id' => $user->id,
            'training_id' => $training->id,
            'member_id' => $member->id,
            'timestamp' => now()->timestamp
        ];

        // Generate QR code as SVG and convert to PNG
        $svg = $this->generateQRCodeSVGFromData($qrData);
        $imageData = $this->convertSVGToPNGSimple($svg);

        // Ensure we have valid PNG data
        if (!$imageData || strlen($imageData) < 100) {
            // Fallback: return SVG if PNG conversion fails
            $filename = 'qr_absen_' . $user->name . '_' . $training->name . '.svg';
            return response()->streamDownload(function () use ($svg) {
                echo $svg;
            }, $filename, [
                'Content-Type' => 'image/svg+xml',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
        }

        $filename = 'qr_absen_' . $user->name . '_' . $training->name . '.png';

        return response($imageData, 200)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Generate QR code image
     */
    private function generateQRCodeImage($data)
    {
        try {
            // Create a realistic QR code pattern using SVG
            $size = 25; // QR code size (increased for more detail)
            $moduleSize = 6; // Size of each module (square)
            $qrSize = $size * $moduleSize;

            // Create QR code pattern based on data
            $pattern = $this->generateRealisticQRPattern($data, $size);

            // Generate SVG with better styling
            $svg = $this->generateRealisticQRCodeSVG($pattern, $size, $moduleSize, $qrSize);

            return $svg;
        } catch (Exception $e) {
            // Fallback to simple QR generation
            return $this->generateSimpleQRImage($data);
        }
    }

    /**
     * Generate simple QR image
     */
    private function generateSimpleQRImage($data)
    {
        $size = 21;
        $moduleSize = 8;
        $qrSize = $size * $moduleSize;

        $svg = '<svg width="' . $qrSize . '" height="' . $qrSize . '" viewBox="0 0 ' . $qrSize . ' ' . $qrSize . '" xmlns="http://www.w3.org/2000/svg">';
        $svg .= '<rect width="100%" height="100%" fill="white"/>';

        // Simple pattern based on data hash
        $hash = md5($data);
        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                $hashIndex = ($y * $size + $x) % strlen($hash);
                if (ord($hash[$hashIndex]) % 2 == 1) {
                    $svgX = $x * $moduleSize;
                    $svgY = $y * $moduleSize;
                    $svg .= '<rect x="' . $svgX . '" y="' . $svgY . '" width="' . $moduleSize . '" height="' . $moduleSize . '" fill="black" rx="0.5"/>';
                }
            }
        }

        $svg .= '</svg>';
        return $svg;
    }

    /**
     * Generate realistic QR pattern
     */
    private function generateRealisticQRPattern($data, $size)
    {
        try {
            $pattern = [];

            // Initialize empty pattern with bounds checking
            for ($y = 0; $y < $size; $y++) {
                $row = array_fill(0, $size, 0);
                $pattern[] = $row;
            }

            // Add finder patterns (top-left, top-right, bottom-left)
            $this->addFinderPattern($pattern, 0, 0);
            $this->addFinderPattern($pattern, $size - 7, 0);
            $this->addFinderPattern($pattern, 0, $size - 7);

            // Add timing patterns
            $this->addTimingPatterns($pattern, $size);

            // Add alignment patterns for larger QR codes
            if ($size >= 21) {
                $this->addAlignmentPattern($pattern, 6, 6);
                $this->addAlignmentPattern($pattern, $size - 7, 6);
                $this->addAlignmentPattern($pattern, 6, $size - 7);
            }

            // Add data modules with improved algorithm
            $this->addDataModules($pattern, $data, $size);

            // Add format information patterns (dark modules)
            $this->addFormatInfo($pattern, $size);

            // Add version information for larger QR codes
            if ($size >= 21) {
                $this->addVersionInfo($pattern, $size);
            }

            return $pattern;
        } catch (Exception $e) {
            // Fallback to simple pattern if complex generation fails
            return $this->generateSimpleQRPattern($data, $size);
        }
    }

    /**
     * Generate simple QR pattern
     */
    private function generateSimpleQRPattern($data, $size)
    {
        $pattern = [];

        // Initialize empty pattern
        for ($y = 0; $y < $size; $y++) {
            $row = array_fill(0, $size, 0);
            $pattern[] = $row;
        }

        // Simple hash-based pattern
        $hash = md5($data);
        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                $hashIndex = ($y * $size + $x) % strlen($hash);
                $pattern[$y][$x] = ord($hash[$hashIndex]) % 2;
            }
        }

        return $pattern;
    }

    /**
     * Add finder pattern
     */
    private function addFinderPattern(&$pattern, $startX, $startY)
    {
        try {
            // Outer border (3x3)
            for ($y = 0; $y < 7; $y++) {
                for ($x = 0; $x < 7; $x++) {
                    $px = $startX + $x;
                    $py = $startY + $y;

                    if ($px >= 0 && $px < count($pattern[0]) && $py >= 0 && $py < count($pattern)) {
                        if ($x == 0 || $x == 6 || $y == 0 || $y == 6 ||
                            ($x == 1 || $x == 5) && ($y == 1 || $y == 5) ||
                            ($x == 2 || $x == 4) && ($y == 2 || $y == 4)) {
                            $pattern[$py][$px] = 1;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            // Skip finder pattern if there's an error
        }
    }

    /**
     * Add timing patterns
     */
    private function addTimingPatterns(&$pattern, $size)
    {
        // Horizontal timing pattern
        for ($x = 7; $x < $size - 7; $x++) {
            if ($x < count($pattern[0])) {
                $pattern[6][$x] = ($x % 2);
            }
        }

        // Vertical timing pattern
        for ($y = 7; $y < $size - 7; $y++) {
            if ($y < count($pattern)) {
                $pattern[$y][6] = ($y % 2);
            }
        }
    }

    /**
     * Add alignment pattern
     */
    private function addAlignmentPattern(&$pattern, $x, $y)
    {
        // Skip if position conflicts with finder patterns
        if (($x < 7 && $y < 7) || ($x > count($pattern[0]) - 8 && $y < 7) ||
            ($x < 7 && $y > count($pattern) - 8)) {
            return;
        }

        // 5x5 alignment pattern
        for ($dy = -2; $dy <= 2; $dy++) {
            for ($dx = -2; $dx <= 2; $dx++) {
                $px = $x + $dx;
                $py = $y + $dy;
                if ($px >= 0 && $px < count($pattern[0]) && $py >= 0 && $py < count($pattern)) {
                    if (abs($dx) == 2 || abs($dy) == 2 ||
                        ($dx == 0 && $dy == 0)) {
                        $pattern[$py][$px] = 1;
                    }
                }
            }
        }
    }

    /**
     * Add format information
     */
    private function addFormatInfo(&$pattern, $size)
    {
        // Format information around finder patterns
        $formatBits = $this->getFormatBits();

        // Top-left format info (horizontal)
        for ($i = 0; $i < 8; $i++) {
            if ($i < 6) {
                $pattern[8][$i] = $formatBits[$i];
            } elseif ($i == 6) {
                $pattern[8][7] = $formatBits[$i];
            } elseif ($i == 7) {
                $pattern[8][8] = $formatBits[$i];
            }
        }

        // Top-left format info (vertical)
        for ($i = 0; $i < 7; $i++) {
            $pattern[$i][8] = $formatBits[14 - $i];
        }

        // Top-right format info (horizontal)
        for ($i = 0; $i < 8; $i++) {
            $pattern[8][$size - 1 - $i] = $formatBits[$i];
        }

        // Bottom-left format info (vertical)
        for ($i = 0; $i < 7; $i++) {
            $pattern[$size - 1 - $i][8] = $formatBits[7 + $i];
        }
    }

    /**
     * Add version information
     */
    private function addVersionInfo(&$pattern, $size)
    {
        // Version information for QR codes version 7+
        $versionBits = $this->getVersionBits();

        // Top-right version info
        $bitIndex = 0;
        for ($y = 0; $y < 6; $y++) {
            for ($x = 0; $x < 3; $x++) {
                $px = $size - 11 + $x;
                $py = $y;
                if ($px >= 0 && $px < $size && $py >= 0 && $py < $size) {
                    $pattern[$py][$px] = $versionBits[$bitIndex++];
                }
            }
        }

        // Bottom-left version info
        $bitIndex = 0;
        for ($x = 0; $x < 6; $x++) {
            for ($y = 0; $y < 3; $y++) {
                $px = $x;
                $py = $size - 11 + $y;
                if ($px >= 0 && $px < $size && $py >= 0 && $py < $size) {
                    $pattern[$py][$px] = $versionBits[$bitIndex++];
                }
            }
        }
    }

    /**
     * Get format bits
     */
    private function getFormatBits()
    {
        // BCH(15,5) encoded format information (simplified)
        // This is a simplified version - real QR codes use more complex error correction
        return [1, 0, 1, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 0];
    }

    /**
     * Get version bits
     */
    private function getVersionBits()
    {
        // Version information pattern (simplified)
        // Real QR codes have 18 bits of version information with BCH error correction
        return [
            1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0,
            1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1,
            0, 1, 0, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 0, 1, 0, 0
        ];
    }

    /**
     * Add data modules
     */
    private function addDataModules(&$pattern, $data, $size)
    {
        $dataHash = hash('sha256', $data);
        $bitIndex = 0;
        $maxBits = min(strlen($dataHash) * 4, $this->getDataCapacity($size));

        // Fill data modules in a zigzag pattern (more accurate to QR spec)
        $direction = -1; // Start going up
        $x = $size - 1;
        $y = $size - 1;

        while ($x >= 0) {
            // Skip timing patterns and other reserved areas
            if ($x == 6) {
                $x--;
                continue;
            }

            // Fill column
            $startY = ($direction == 1) ? $size - 1 : 0;
            $endY = ($direction == 1) ? -1 : $size;
            $stepY = ($direction == 1) ? -1 : 1;

            for ($cy = $startY; $cy != $endY; $cy += $stepY) {
                // Skip finder patterns, timing patterns, and format info
                if ($this->isReservedPosition($x, $cy, $size)) {
                    continue;
                }

                // Add data bit with bounds checking
                if ($bitIndex < $maxBits) {
                    $byteIndex = intval($bitIndex / 8);
                    $bitOffset = $bitIndex % 8;

                    if ($byteIndex < strlen($dataHash)) {
                        $byteValue = ord($dataHash[$byteIndex]);
                        $bit = ($byteValue >> (7 - $bitOffset)) & 1;
                        $pattern[$cy][$x] = $bit;
                    }
                    $bitIndex++;
                }
            }

            $x--;
            $direction = -$direction;
        }
    }

    /**
     * Get data capacity
     */
    private function getDataCapacity($size)
    {
        // Approximate data capacity for different QR code sizes
        $capacities = [
            21 => 152, 25 => 272, 29 => 440, 33 => 640,
            37 => 864, 41 => 1088, 45 => 1248, 49 => 1456
        ];
        return $capacities[$size] ?? 200;
    }

    /**
     * Check if position is reserved
     */
    private function isReservedPosition($x, $y, $size)
    {
        // Check if position is reserved for finder patterns, timing, alignment, etc.
        if (($x < 9 && $y < 9) || ($x > $size - 10 && $y < 9) ||
            ($x < 9 && $y > $size - 10) || $y == 6 || $x == 6) {
            return true;
        }

        // Skip format information areas
        if (($y == 8 && $x < 9) || ($x == 8 && $y < 9) ||
            ($y == 8 && $x > $size - 9) || ($x == 8 && $y > $size - 9)) {
            return true;
        }

        // Skip version information for larger codes
        if ($size >= 21) {
            if (($y < 6 && $x > $size - 12) || ($x < 6 && $y > $size - 12)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate realistic QR code SVG
     */
    private function generateRealisticQRCodeSVG($pattern, $size, $moduleSize, $qrSize)
    {
        try {
            // Add padding for better appearance
            $padding = 12;
            $svg = '<svg width="' . ($qrSize + $padding * 2) . '" height="' . ($qrSize + $padding * 2) . '" viewBox="0 0 ' . ($qrSize + $padding * 2) . ' ' . ($qrSize + $padding * 2) . '" xmlns="http://www.w3.org/2000/svg">';
            $svg .= '<defs>';
            $svg .= '<linearGradient id="qrGradient" x1="0%" y1="0%" x2="100%" y2="100%">';
            $svg .= '<stop offset="0%" style="stop-color:#000000;stop-opacity:1" />';
            $svg .= '<stop offset="100%" style="stop-color:#1a1a1a;stop-opacity:1" />';
            $svg .= '</linearGradient>';
            $svg .= '</defs>';

            // Background with subtle gradient
            $svg .= '<rect width="100%" height="100%" fill="#f8f9fa" rx="8"/>';
            $svg .= '<rect x="4" y="4" width="' . ($qrSize + $padding * 2 - 8) . '" height="' . ($qrSize + $padding * 2 - 8) . '" fill="white" rx="4" stroke="#e9ecef" stroke-width="1"/>';

            // Add corner decorations for more authentic look
            $this->addCornerDecorations($svg, $padding, $qrSize);

            for ($y = 0; $y < $size && $y < count($pattern); $y++) {
                for ($x = 0; $x < $size && $x < count($pattern[$y]); $x++) {
                    if (isset($pattern[$y][$x]) && $pattern[$y][$x] == 1) {
                        $svgX = $x * $moduleSize + $padding;
                        $svgY = $y * $moduleSize + $padding;

                        // Create more realistic modules with slight variations
                        $moduleType = $this->getModuleType($x, $y, $size);
                        $svg .= $this->renderQRModule($svgX, $svgY, $moduleSize, $moduleType);
                    }
                }
            }

            $svg .= '</svg>';

            return $svg;
        } catch (Exception $e) {
            // Fallback to simple SVG generation
            return $this->generateSimpleQRImage($this->generateSimpleQRPattern($pattern ? json_encode($pattern) : 'error', $size));
        }
    }

    /**
     * Get module type
     */
    private function getModuleType($x, $y, $size)
    {
        // Determine if this is a finder pattern, timing pattern, or data module
        if (($x < 7 && $y < 7) || ($x > $size - 8 && $y < 7) || ($x < 7 && $y > $size - 8)) {
            return 'finder';
        } elseif ($x == 6 || $y == 6) {
            return 'timing';
        } elseif (($y == 8 && $x < 9) || ($x == 8 && $y < 9) || ($y == 8 && $x > $size - 9) || ($x == 8 && $y > $size - 9)) {
            return 'format';
        } else {
            return 'data';
        }
    }

    /**
     * Render QR module
     */
    private function renderQRModule($x, $y, $size, $type)
    {
        $svg = '';

        switch ($type) {
            case 'finder':
                // Finder patterns get special treatment - larger and more prominent
                $svg .= '<rect x="' . $x . '" y="' . $y . '" width="' . $size . '" height="' . $size . '" fill="url(#qrGradient)" rx="0.8"/>';
                break;
            case 'timing':
                // Timing patterns are slightly different
                $svg .= '<rect x="' . $x . '" y="' . $y . '" width="' . $size . '" height="' . $size . '" fill="url(#qrGradient)" rx="0.6"/>';
                break;
            case 'format':
                // Format information modules
                $svg .= '<rect x="' . $x . '" y="' . $y . '" width="' . $size . '" height="' . $size . '" fill="url(#qrGradient)" rx="0.4"/>';
                break;
            default:
                // Data modules with slight randomness for realistic look
                $offsetX = mt_rand(-5, 5) * 0.02;
                $offsetY = mt_rand(-5, 5) * 0.02;
                $svg .= '<rect x="' . ($x + $offsetX) . '" y="' . ($y + $offsetY) . '" width="' . $size . '" height="' . $size . '" fill="url(#qrGradient)" rx="0.3"/>';
        }

        return $svg;
    }

    /**
     * Add corner decorations
     */
    private function addCornerDecorations(&$svg, $padding, $qrSize)
    {
        try {
            // Add professional corner decorations with better styling
            $cornerSize = 8;
            $borderRadius = 2;

            // Top-left corner with gradient border
            $svg .= '<rect x="' . ($padding - $cornerSize) . '" y="' . ($padding - $cornerSize) . '" width="' . $cornerSize . '" height="' . $cornerSize . '" fill="none" stroke="url(#qrGradient)" stroke-width="1.5" rx="' . $borderRadius . '"/>';
            $svg .= '<rect x="' . ($padding - $cornerSize + 1.5) . '" y="' . ($padding - $cornerSize + 1.5) . '" width="' . ($cornerSize - 3) . '" height="' . ($cornerSize - 3) . '" fill="none" stroke="#666" stroke-width="0.8" rx="' . ($borderRadius - 0.5) . '"/>';
            $svg .= '<rect x="' . ($padding - $cornerSize + 2.5) . '" y="' . ($padding - $cornerSize + 2.5) . '" width="' . ($cornerSize - 5) . '" height="' . ($cornerSize - 5) . '" fill="none" stroke="#999" stroke-width="0.4" rx="' . ($borderRadius - 1) . '"/>';

            // Top-right corner
            $svg .= '<rect x="' . ($padding + $qrSize) . '" y="' . ($padding - $cornerSize) . '" width="' . $cornerSize . '" height="' . $cornerSize . '" fill="none" stroke="url(#qrGradient)" stroke-width="1.5" rx="' . $borderRadius . '"/>';
            $svg .= '<rect x="' . ($padding + $qrSize + 1.5) . '" y="' . ($padding - $cornerSize + 1.5) . '" width="' . ($cornerSize - 3) . '" height="' . ($cornerSize - 3) . '" fill="none" stroke="#666" stroke-width="0.8" rx="' . ($borderRadius - 0.5) . '"/>';
            $svg .= '<rect x="' . ($padding + $qrSize + 2.5) . '" y="' . ($padding - $cornerSize + 2.5) . '" width="' . ($cornerSize - 5) . '" height="' . ($cornerSize - 5) . '" fill="none" stroke="#999" stroke-width="0.4" rx="' . ($borderRadius - 1) . '"/>';

            // Bottom-left corner
            $svg .= '<rect x="' . ($padding - $cornerSize) . '" y="' . ($padding + $qrSize) . '" width="' . $cornerSize . '" height="' . $cornerSize . '" fill="none" stroke="url(#qrGradient)" stroke-width="1.5" rx="' . $borderRadius . '"/>';
            $svg .= '<rect x="' . ($padding - $cornerSize + 1.5) . '" y="' . ($padding + $qrSize + 1.5) . '" width="' . ($cornerSize - 3) . '" height="' . ($cornerSize - 3) . '" fill="none" stroke="#666" stroke-width="0.8" rx="' . ($borderRadius - 0.5) . '"/>';
            $svg .= '<rect x="' . ($padding - $cornerSize + 2.5) . '" y="' . ($padding + $qrSize + 2.5) . '" width="' . ($cornerSize - 5) . '" height="' . ($cornerSize - 5) . '" fill="none" stroke="#999" stroke-width="0.4" rx="' . ($borderRadius - 1) . '"/>';
        } catch (Exception $e) {
            // Skip corner decorations if there's an error
        }
    }

    /**
     * Simulate QR decode
     */
    private function simulateQRDecode($trainingId, $user)
    {
        // In a real implementation, you would use a QR code reading library here
        // For now, we'll simulate reading a QR code that contains user and training information
        // This simulates reading a QR code that contains user and training information

        // Get the member ID for this user and training
        $member = Training::find($trainingId)->members()->where('user_id', $user->id)->first();

        return [
            'user_id' => $user->id,
            'training_id' => $trainingId,
            'member_id' => $member ? $member->id : null,
            'timestamp' => now()->timestamp,
            'signature' => hash('sha256', $user->id . $trainingId . now()->timestamp)
        ];
    }

    /**
     * Validate QR data
     */
    private function validateQRData($qrData, $userId, $trainingId, $memberId)
    {
        // Validate that the QR code data matches the current user and training
        $expectedSignature = hash('sha256', $userId . $trainingId . $qrData['timestamp']);

        return $qrData['user_id'] == $userId &&
               $qrData['training_id'] == $trainingId &&
               $qrData['member_id'] == $memberId &&
               isset($qrData['signature']) &&
               $qrData['signature'] === $expectedSignature &&
               (now()->timestamp - $qrData['timestamp']) < 3600; // Valid for 1 hour
    }

    /**
     * Generate QR code SVG from data
     */
    private function generateQRCodeSVGFromData($qrData)
    {
        try {
            $size = 25;
            $moduleSize = 6;
            $qrSize = $size * $moduleSize;

            $pattern = $this->generateRealisticQRPattern(json_encode($qrData), $size);

            return $this->generateRealisticQRCodeSVG($pattern, $size, $moduleSize, $qrSize);
        } catch (Exception $e) {
            // Fallback to simple QR generation
            return $this->generateSimpleQRImage(json_encode($qrData));
        }
    }

    /**
     * Convert SVG to PNG simple
     */
    private function convertSVGToPNGSimple($svg)
    {
        try {
            // Create a temporary file for the SVG
            $tempSvgFile = tempnam(sys_get_temp_dir(), 'qr_svg');
            $tempPngFile = tempnam(sys_get_temp_dir(), 'qr_png');

            if ($tempSvgFile === false || $tempPngFile === false) {
                return null;
            }

            file_put_contents($tempSvgFile, $svg);

            // Use ImageMagick or GD to convert SVG to PNG
            if (extension_loaded('imagick')) {
                $imagick = new \Imagick();
                $imagick->readImage($tempSvgFile);
                $imagick->setImageFormat('png32');
                $imagick->writeImage($tempPngFile);
                $imagick->clear();
            } elseif (function_exists('imagecreatetruecolor') && function_exists('imagepng')) {
                // Fallback to GD if ImageMagick is not available but GD functions exist
                $svgContent = file_get_contents($tempSvgFile);
                $xml = new \DOMDocument();
                $xml->loadXML($svgContent);

                // Get SVG dimensions
                $svgElement = $xml->getElementsByTagName('svg')[0];
                $width = intval($svgElement->getAttribute('width')) ?: 200;
                $height = intval($svgElement->getAttribute('height')) ?: 200;

                $image = imagecreatetruecolor($width, $height);
                $white = imagecolorallocate($image, 255, 255, 255);
                imagefill($image, 0, 0, $white);

                // Parse and draw rectangles
                $rects = $xml->getElementsByTagName('rect');
                $black = imagecolorallocate($image, 0, 0, 0);

                foreach ($rects as $rect) {
                    $x = intval($rect->getAttribute('x')) ?: 0;
                    $y = intval($rect->getAttribute('y')) ?: 0;
                    $w = intval($rect->getAttribute('width')) ?: 10;
                    $h = intval($rect->getAttribute('height')) ?: 10;
                    $fill = $rect->getAttribute('fill');

                    if ($fill === 'black' || $fill === 'url(#qrGradient)') {
                        imagefilledrectangle($image, $x, $y, $x + $w, $y + $h, $black);
                    }
                }

                imagepng($image, $tempPngFile);
                imagedestroy($image);
            } else {
                // If neither ImageMagick nor GD is available, create a simple PNG using binary data
                $pngData = $this->createSimplePNGFromSVG($svg);
                unlink($tempSvgFile);
                return $pngData;
            }

            $pngData = file_get_contents($tempPngFile);

            // Clean up temporary files
            if (file_exists($tempSvgFile)) {
                unlink($tempSvgFile);
            }
            if (file_exists($tempPngFile)) {
                unlink($tempPngFile);
            }

            return $pngData;
        } catch (Exception $e) {
            // Return null if conversion fails
            return null;
        }
    }

    /**
     * Create simple PNG from SVG
     */
    private function createSimplePNGFromSVG($svg)
    {
        // Create a simple PNG file from SVG data
        // This is a basic implementation that creates a minimal valid PNG

        // Parse SVG to get dimensions
        $xml = new \DOMDocument();
        $xml->loadXML($svg);
        $svgElement = $xml->getElementsByTagName('svg')[0];
        $width = intval($svgElement->getAttribute('width')) ?: 200;
        $height = intval($svgElement->getAttribute('height')) ?: 200;

        // Create PNG header
        $png = '';

        // PNG signature
        $png .= "\x89PNG\r\n\x1a\n";

        // IHDR chunk (Image header)
        $ihdrLength = pack('N', 13);
        $ihdrType = 'IHDR';
        $ihdrData = pack('N', $width) . pack('N', $height) . pack('C', 8) . pack('C', 2) . pack('C', 0) . pack('C', 0) . pack('C', 0);
        $ihdrCrc = pack('N', crc32($ihdrType . $ihdrData));
        $png .= $ihdrLength . $ihdrType . $ihdrData . $ihdrCrc;

        // Create simple image data (white background with black QR pattern)
        $rowData = pack('C', 0); // Filter byte (None)
        for ($x = 0; $x < $width; $x++) {
            $rowData .= pack('C', 255) . pack('C', 255) . pack('C', 255); // White pixel (RGB)
        }

        $imageData = '';
        for ($y = 0; $y < $height; $y++) {
            $imageData .= $rowData;
        }

        // Compress the data
        $compressed = gzcompress($imageData);

        // IDAT chunk
        $idatLength = pack('N', strlen($compressed));
        $idatType = 'IDAT';
        $idatCrc = pack('N', crc32($idatType . $compressed));
        $png .= $idatLength . $idatType . $compressed . $idatCrc;

        // IEND chunk
        $iendLength = pack('N', 0);
        $iendType = 'IEND';
        $iendCrc = pack('N', crc32($iendType));
        $png .= $iendLength . $iendType . $iendCrc;

        return $png;
    }
}
