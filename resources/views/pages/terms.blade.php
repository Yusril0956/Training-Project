@extends('layouts.dashboard')

@section('content')
  <div class="page-wrapper">
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="row g-0">
            <div class="col-12 col-md-9 d-flex flex-column">
                <div class="card-body">
                    <h1 class="card-title">Terms & Conditions</h1>
                    <p class="text-muted">PT Dirgantara Indonesia (Indonesian Aerospace / IAe)</p>

                    <h3 class="mt-4">1. Company Overview</h3>
                    <p>
                        PT Dirgantara Indonesia (Persero), also known as Indonesian Aerospace (IAe), is a state-owned enterprise specializing in the design, development, manufacturing, and maintenance of aircraft for both civilian and military use. Established in 1976 and headquartered in Bandung, West Java, IAe serves clients across Asia Pacific, the Middle East, Africa, and Latin America.
                    </p>

                    <h3 class="mt-4">2. Intellectual Property</h3>
                    <p>
                        All aircraft designs, engineering documentation, and proprietary technologies developed by IAe are protected under Indonesian and international intellectual property laws. Unauthorized use, reproduction, or distribution of IAe materials is strictly prohibited.
                    </p>

                    <h3 class="mt-4">3. Product Usage</h3>
                    <p>
                        IAe products—including aircraft such as the NC212i, CN235, and N219—are intended for certified operators and must be used in accordance with aviation safety regulations. IAe is not liable for misuse or unauthorized modifications of its products.
                    </p>

                    <h3 class="mt-4">4. Partnerships & Licensing</h3>
                    <p>
                        IAe collaborates with global aerospace leaders such as Airbus and Bell Helicopters. Any licensing or joint venture agreements are governed by separate contractual terms and subject to mutual compliance with international standards.
                    </p>

                    <h3 class="mt-4">5. Warranty & Liability</h3>
                    <p>
                        IAe provides warranties for its products as specified in individual contracts. Liability is limited to the scope defined in the agreement and does not extend to indirect or consequential damages.
                    </p>

                    <h3 class="mt-4">6. Compliance & Ethics</h3>
                    <p>
                        IAe adheres to ethical business practices and complies with Indonesian government regulations, including export controls, environmental standards, and anti-corruption laws.
                    </p>

                    <h3 class="mt-4">7. Amendments</h3>
                    <p>
                        These terms are subject to change without prior notice. Updates will be posted on the official website of PT Dirgantara Indonesia.
                    </p>

                    <p class="mt-5 text-muted">
                        For more information, visit the [corporate overview](https://www.indonesian-aerospace.com/en/about_us/corporate_overview) or [company history](http://www.dirgantara-indonesia.com/about/history.html) of PT Dirgantara Indonesia.
                    </p>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    @include('partials._footer')
  </div>
@endsection