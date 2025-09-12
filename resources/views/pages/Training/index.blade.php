@extends('layouts.app')
@section('title', 'Training')

@section('content')
    <!-- Page body -->
    <div class="page-body pt-2">
        <div class="container-xl">
            
            @include('partials._breadcrumb', [
                'items' => [['title' => 'Training', 'url' => route('training.index')]],
            ])



            <!-- Hero Section -->
            <div class="card mb-4">
                <div class="card-body text-center py-5">
                    <h1 class="card-title">Welcome to Training Portal</h1>
                    <p class="card-subtitle text-muted">Explore various training programs to enhance your skills and
                        compliance.</p>
                </div>
            </div>

<!-- Tombol Mulai Training -->
<div class="text-center mb-4">
  <button id="startTrainingBtn" class="btn btn-primary btn-lg" type="button" aria-controls="trainingCards" aria-expanded="false">
    Mulai Training
  </button>
</div>

<!-- TRAINING CARDS (TERSEMBUNYI AWAL) -->
<div class="row row-cards mb-4" id="trainingCards" style="display:none;">
  <!-- General Knowledge -->
  <div class="col-sm-6 col-lg-3 training-card" style="opacity:0; transform: translateY(24px) scale(.98);">
    <div class="card card-sm">
      <div class="card-body text-center">
        <div class="mb-3"><span class="avatar avatar-xl bg-blue-lt text-blue">GK</span></div>
        <h3 class="card-title">General Knowledge</h3>
        <p class="text-muted">Broaden your understanding across various domains.</p>
        <a href="{{ route('general.knowledge') }}" class="btn btn-primary btn-sm">Explore</a>
      </div>
    </div>
  </div>

  <!-- Mandatory -->
  <div class="col-sm-6 col-lg-3 training-card" style="opacity:0; transform: translateY(24px) scale(.98);">
    <div class="card card-sm">
      <div class="card-body text-center">
        <div class="mb-3"><span class="avatar avatar-xl bg-red-lt text-red">MD</span></div>
        <h3 class="card-title">Mandatory</h3>
        <p class="text-muted">Required trainings for compliance and safety.</p>
        <a href="{{ route('mandatory.training') }}" class="btn btn-danger btn-sm">View</a>
      </div>
    </div>
  </div>

  <!-- Customer Requested -->
  <div class="col-sm-6 col-lg-3 training-card" style="opacity:0; transform: translateY(24px) scale(.98);">
    <div class="card card-sm">
      <div class="card-body text-center">
        <div class="mb-3"><span class="avatar avatar-xl bg-green-lt text-green">CR</span></div>
        <h3 class="card-title">Customer Requested</h3>
        <p class="text-muted">Tailored trainings based on client needs.</p>
        <a href="{{ route('customer.requested') }}" class="btn btn-success btn-sm">Details</a>
      </div>
    </div>
  </div>

  <!-- License -->
  <div class="col-sm-6 col-lg-3 training-card" style="opacity:0; transform: translateY(24px) scale(.98);">
    <div class="card card-sm">
      <div class="card-body text-center">
        <div class="mb-3"><span class="avatar avatar-xl bg-yellow-lt text-yellow">LC</span></div>
        <h3 class="card-title">License</h3>
        <p class="text-muted">Certifications and licensed training programs.</p>
        <a href="{{ route('license.training') }}" class="btn btn-warning btn-sm">Start</a>
      </div>
    </div>
  </div>
</div>

<!-- STYLE (letakkan di <head> jika memungkinkan) -->
<style>
/* dasar animasi: per-card ditransisikan transform & opacity */
.training-card {
  transition: transform 450ms cubic-bezier(.22,.9,.6,1), opacity 420ms ease;
  will-change: transform, opacity;
  pointer-events: none; /* non-interactive sampai muncul */
}
.training-card.visible {
  opacity: 1 !important;
  transform: translateY(0) scale(1) !important;
  pointer-events: auto;
}
</style>

<!-- SCRIPT (letakkan sebelum </body> atau di file JS utama) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const btn = document.getElementById('startTrainingBtn');
  const container = document.getElementById('trainingCards');
  const cardsSelector = '.training-card';

  btn.addEventListener('click', function () {
    if (container.style.display !== 'none') return;

    // tampilkan container
    container.style.display = 'flex';
    btn.setAttribute('aria-expanded', 'true');
    container.setAttribute('aria-hidden', 'false');

    void container.offsetWidth; // force reflow

    const cards = container.querySelectorAll(cardsSelector);
    const delay = 120;   // ms
    const duration = 450; // ms

    cards.forEach((card, index) => {
      card.style.transitionDelay = (index * delay) + 'ms';
      setTimeout(() => card.classList.add('visible'), 20);
    });

    // sembunyikan tombol setelah semua animasi selesai
    const totalTime = (cards.length - 1) * delay + duration;
    setTimeout(() => {
      btn.style.display = 'none';
    }, totalTime + 100); // kasih buffer 100ms biar aman
  });
});
</script>



            <!-- Bagian kalender -->

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Kalender Training</h3>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Rekomendasi Training</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Pelatihan Audit Internal ISO 9001</li>
                        <li class="list-group-item">Simulasi Emergency Response</li>
                        <li class="list-group-item">Training Sistem Avionik Dasar</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route('calendar.events') }}',
                eventClick: function(info) {
                    alert('Training: ' + info.event.title);
                }
            });

            calendar.render();
        });
    </script>
@endpush


@endsection
