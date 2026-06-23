<section class="reveal comparison-prototype-section" style="background: #fff; padding: 80px 0;">
    <div class="container container-two">
        <div class="reveal section-heading text-center" style="margin-bottom: 50px;">
            <h3 style="font-size: 32px; font-weight: 800; color: #1b1b18;">Why Choose <span>Softyskin?</span></h3>
            <p style="color: #666; margin-top: 10px;">Compare our advanced Ice Cooling technology with traditional hair removal methods.</p>
        </div>

        {{-- Mobile image: shown only on ≤400px instead of the broken table layout --}}
        <img src="{{ asset('media/images/comparison-table-mobile.png') }}"
             alt="Comparison table: ICE COOLING PRO 3 vs Razor, Waxing, Salon Laser"
             class="comparison-mobile-img"
             loading="lazy"
             width="900" height="500">

        <div class="comparison-table-container">
            <div class="table-scroll-wrapper">
                <table class="comparison-ui-table">
                    <thead>
                        <tr>
                            <th class="col-features">FEATURES</th>
                            <th class="col-hero">ICE COOLING PRO 3</th>
                            <th>RAZOR</th>
                            <th>WAXING</th>
                            <th>SALON LASER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="feature-label">Permanent Hair Reduction</td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                        </tr>
                        <tr>
                            <td class="feature-label">Painless & Skin Friendly</td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                        </tr>
                        <tr>
                            <td class="feature-label">Safe for Face & Body</td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                        </tr>
                        <tr>
                            <td class="feature-label">Cost Effective</td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                        </tr>
                        <tr>
                            <td class="feature-label">Long-lasting Results</td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                        </tr>
                        <tr>
                            <td class="feature-label">Use at Home</td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                            <td><div class="badge-icon badge-check"><i class="fas fa-check"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                            <td><div class="badge-icon badge-cross"><i class="fas fa-times"></i></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>{{-- /.table-scroll-wrapper --}}
        </div>{{-- /.comparison-table-container --}}
    </div>
</section>

<style>
/* --- Comparison Table Styles --- */

/* Mobile image: only visible at ≤400px */
.comparison-mobile-img {
    display: none;
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    border: 1px solid #f0f0f0;
}

@media (max-width: 400px) {
    .comparison-mobile-img { display: block; }
    .comparison-table-container { display: none; }
}

.comparison-table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    overflow: hidden; /* fallback: older Safari clips to border-radius */
    overflow: clip;   /* modern: clips to border-radius without blocking child scroll */
    border: 1px solid #f0f0f0;
}

/* Scrollable wrapper so table never squishes below its min-width */
.table-scroll-wrapper {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

/* Legacy app.css has a global ≤575px "responsive cart table" hack
   (table,thead,tbody,th,td,tr{display:block} + thead tr{top:-9999px})
   that is NOT scoped and breaks every table site-wide. Restore proper
   table semantics for THIS table only so it scrolls instead of stacking. */
.comparison-ui-table        { display: table; }
.comparison-ui-table thead  { display: table-header-group; }
.comparison-ui-table tbody  { display: table-row-group; }
.comparison-ui-table tr     { display: table-row; border: 0; }
.comparison-ui-table th,
.comparison-ui-table td      { display: table-cell; }
.comparison-ui-table thead tr { position: static; top: auto; left: auto; }

.comparison-ui-table {
    width: 100%;
    min-width: 520px;
    border-collapse: collapse;
    background: #fff;
}

/* Header */
.comparison-ui-table thead th {
    background: #d19e66; /* Brand gold/beige */
    color: #fff;
    padding: 24px 15px;
    text-align: center;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    border-right: 1px solid rgba(255,255,255,0.1);
}

.comparison-ui-table thead th:last-child {
    border-right: none;
}

.comparison-ui-table thead th.col-features {
    background: #c28d51; /* Slightly darker gold */
    text-align: left;
    padding-left: 35px;
    width: 30%;
}

.comparison-ui-table thead th.col-hero {
    background: #b67e42; /* Highlighted hero column header */
}

/* Body Rows */
.comparison-ui-table tbody td {
    padding: 20px 15px;
    text-align: center;
    border-bottom: 1px solid #f5f5f5;
    font-size: 15px;
    color: #444;
}

.comparison-ui-table tbody tr:last-child td {
    border-bottom: none;
}

.comparison-ui-table tbody td.feature-label {
    text-align: left;
    padding-left: 35px;
    font-weight: 700;
    color: #1b1b18;
    background: #fafafa;
}

/* Icons / Badges */
.badge-icon {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
}

.badge-check {
    background-color: #16a34a; /* Precise Green */
}

.badge-cross {
    background-color: #dc2626; /* Precise Red */
}

/* Hero column vertical highlight */
.comparison-ui-table td:nth-child(2) {
    background: rgba(209, 158, 102, 0.03);
}

/* Responsive */
@media (max-width: 991px) {
    .comparison-ui-table thead th {
        padding: 15px 10px;
        font-size: 11px;
    }
    .comparison-ui-table tbody td {
        padding: 15px 10px;
        font-size: 13px;
    }
    .comparison-ui-table thead th.col-features,
    .comparison-ui-table tbody td.feature-label {
        padding-left: 15px;
        width: 140px;
        min-width: 140px;
    }
    .badge-icon {
        width: 22px;
        height: 22px;
        font-size: 10px;
    }
}

@media (max-width: 767px) {
    .comparison-prototype-section {
        padding: 50px 0;
    }
}
</style>
