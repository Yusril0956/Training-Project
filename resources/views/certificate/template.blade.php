<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Sertifikat Pelatihan</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

    body {
      font-family: 'Montserrat', sans-serif;
      text-align: center;
      padding: 2cm;
      border: 15px solid #007bff;
      background: linear-gradient(135deg, #f0f4ff, #d9e4ff);
      color: #333;
      position: relative;
      height: 100%;
      box-sizing: border-box;
    }
    h1 {
      font-size: 56px;
      margin-bottom: 0.5rem;
      color: #004085;
      text-transform: uppercase;
      letter-spacing: 4px;
      font-weight: 700;
    }
    .subtitle {
      font-size: 28px;
      margin-bottom: 2rem;
      color: #0056b3;
      font-weight: 600;
    }
    .info {
      font-size: 20px;
      margin: 0.75rem 0;
      color: #212529;
    }
    .footer {
      position: absolute;
      bottom: 2cm;
      width: 100%;
      text-align: center;
      font-size: 14px;
      color: #6c757d;
      font-style: italic;
    }
    .highlight {
      color: #007bff;
      font-weight: 700;
    }
    .border-decor {
      position: absolute;
      top: 1cm;
      left: 1cm;
      right: 1cm;
      bottom: 1cm;
      border: 5px dashed #007bff;
      pointer-events: none;
      box-sizing: border-box;
    }
  </style>
</head>
<body>
  <div class="border-decor"></div>
  <h1>SERTIFIKAT</h1>
  <div class="subtitle">Diberikan kepada</div>

  <div class="info highlight">{{ $user->name }}</div>
  <div class="info">Telah menyelesaikan pelatihan</div>
  <div class="info highlight">{{ $training->name }}</div>
  <div class="info">
    Periode {{ \Carbon\Carbon::parse($training->detail->start_date)->format('d M Y') }}
    &ndash;
    {{ \Carbon\Carbon::parse($training->detail->end_date)->format('d M Y') }}
  </div>

  <div class="footer">
    No. Sertifikat: {{ $certificateNumber }}<br/>
    {{ now()->format('d M Y') }}
  </div>
</body>
</html>
