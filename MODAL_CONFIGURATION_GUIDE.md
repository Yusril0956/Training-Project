# Configurable Modal System Guide

## Overview

The modal system has been enhanced to support session-based configuration, similar to how alerts work. You can now display modals with custom titles, messages, button text, and styles using session variables.

## Available Session Variables

- `modal_type`: Type of modal (danger, success, warning, info)
- `modal_title`: Title text for the modal
- `modal_message`: Main message content
- `modal_button_text`: Text for the confirmation button
- `modal_button_class`: CSS class for the button (e.g., btn-success, btn-warning)

## Usage Examples

### Success Modal
```php
return redirect()->back()
    ->with('modal_type', 'success')
    ->with('modal_title', 'Operasi Berhasil')
    ->with('modal_message', 'Data telah berhasil disimpan!')
    ->with('modal_button_text', 'OK')
    ->with('modal_button_class', 'btn-success');
```

### Warning Modal
```php
return redirect()->back()
    ->with('modal_type', 'warning')
    ->with('modal_title', 'Peringatan')
    ->with('modal_message', 'Anda yakin ingin melanjutkan?')
    ->with('modal_button_text', 'Ya, Lanjutkan')
    ->with('modal_button_class', 'btn-warning');
```

### Info Modal
```php
return redirect()->back()
    ->with('modal_type', 'info')
    ->with('modal_title', 'Informasi')
    ->with('modal_message', 'Fitur ini akan tersedia dalam versi berikutnya.')
    ->with('modal_button_text', 'Mengerti')
    ->with('modal_button_class', 'btn-info');
```

### Danger Modal (Default)
```php
return redirect()->back()
    ->with('modal_type', 'danger')
    ->with('modal_title', 'Konfirmasi Hapus')
    ->with('modal_message', 'Apakah Anda yakin ingin menghapus data ini?')
    ->with('modal_button_text', 'Hapus')
    ->with('modal_button_class', 'btn-danger');
```

## Modal Types and Styles

1. **Danger** (default): Red theme, used for critical actions like deletion
2. **Success**: Green theme, used for successful operations
3. **Warning**: Orange theme, used for warnings and confirmations
4. **Info**: Blue theme, used for informational messages

## Backward Compatibility

The original `modal-danger` modal is still available for existing code that uses the hardcoded delete confirmation modal.

## JavaScript Integration

The modal automatically appears when session variables are present. You can add custom actions by modifying the JavaScript in `admin.blade.php`:

```javascript
document.getElementById('btn-confirm-action').addEventListener('click', function() {
    // Custom action based on modal type
    if ('{{ session('modal_type') }}' === 'success') {
        // Success action
    } else if ('{{ session('modal_type') }}' === 'warning') {
        // Warning action
    }
});
```

## Test Route

A test route is available at `/admin/example-modal` that demonstrates the success modal configuration.

## Files Modified

1. `resources/views/partials/_modal.blade.php` - Added configurable modal
2. `app/Http/Controllers/DashboardController.php` - Added example method
3. `routes/web.php` - Added example route
4. `resources/views/pages/admin.blade.php` - Added auto-show JavaScript
