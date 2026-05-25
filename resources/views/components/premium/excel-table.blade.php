@props(['hover' => true, 'blueHeader' => false])

<style>
    .table-excel {
        font-size: 0.75rem !important;
        width: 100% !important;
        border-collapse: collapse !important;
    }

    .table-excel th {
        background: {{ $blueHeader ? '#4e73df' : '#f8f9fc' }} !important;
        color: {{ $blueHeader ? '#ffffff' : '#4e73df' }} !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        padding: 4px 6px !important;
        border: 1px solid {{ $blueHeader ? '#4e73df' : '#e3e6f0' }} !important;
        vertical-align: middle !important;
        letter-spacing: 0.5px;
    }

    .table-excel td {
        padding: 2px 5px !important;
        border: 1px solid #e3e6f0 !important;
        vertical-align: middle !important;
        line-height: 1.2 !important;
    }

    /* 🔥 Standard Blue Block Headers (Ledger blocks, Categories, etc.) */
    .txn-block-header,
    .table-excel tr.category-header td,
    .table-excel tr.road-header td {
        background-color: #4e73df !important;
        color: #ffffff !important;
        padding: 3px 8px !important;
        font-weight: 600 !important;
        border: 1px solid #4e73df !important;
        line-height: 1.2 !important;
    }

    .txn-block-header .label {
        color: #bdc3c7 !important;
        margin-right: 5px;
        font-weight: 400;
    }

    .txn-block-header .value {
        margin-right: 25px;
    }

    /* 🔥 No-hover Logic */
    .table-excel tr.no-hover td,
    .table-excel tr.category-header td,
    .table-excel tr.road-header td,
    .table-excel tr.bg-dark td,
    .table-excel tr.bg-primary td {
        --bs-table-hover-bg: transparent !important;
        --bs-table-accent-bg: transparent !important;
        box-shadow: none !important;
    }

    /* thead hover fix */
    .table-excel thead tr:hover th {
        background-color: {{ $blueHeader ? '#4e73df' : '#f8f9fc' }} !important;
        color: {{ $blueHeader ? '#ffffff' : '#4e73df' }} !important;
        --bs-table-hover-bg: transparent !important;
        box-shadow: none !important;
    }

    /* 🔥 Common Ledger Utility Classes */
    .item-desc {
        color: #444;
        font-weight: 400;
    }

    .item-math {
        color: #7f8c8d;
        font-size: 0.8rem;
    }

    .amount-debit {
        color: #e74c3c;
        font-weight: 600;
    }

    .amount-credit {
        color: #27ae60;
        font-weight: 600;
    }

    .total-row {
        background: #f5f5fb !important;
        border-top: 2px solid #5156be !important;
        font-weight: 700;
    }

    .total-row td {
        padding: 2px 5px !important;
        border: 1px solid #d0d0e8 !important;
    }

    .balance-row {
        background: #eeeeff !important;
    }

    .balance-row td {
        padding: 2px 5px !important;
        border: 1px solid #c0c0e0 !important;
        border-top: 1px dashed #9999cc !important;
    }

    .total-row-label,
    .balance-row-label {
        text-align: right;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .total-row-label {
        color: #2980b9;
    }

    .balance-row-label {
        color: #5156be;
    }

    .total-amount-val {
        font-size: 0.83rem;
        font-weight: 600;
    }

    .balance-amount-val {
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .user-line {
        font-size: 0.72rem;
        color: #7f8c8d;
        background: #f9f9f9 !important;
    }

    .user-line td {
        padding: 2px 5px !important;
    }

    .balance-positive {
        color: #c0392b;
    }

    .balance-negative {
        color: #27ae60;
    }

    .balance-zero {
        color: #777;
    }

    /* Final Balance Row (The dark one at the end) */
    .table-excel tr.final-balance-row td {
        background: #1a1a2e !important;
        color: #fff !important;
        font-weight: 700;
        font-size: .85rem;
        padding: 4px 6px !important;
    }

    /* Print Utilities */
    @media print {
        .no-print {
            display: none !important;
        }

        .table-responsive {
            overflow: visible !important;
        }

        /* Forces table header to repeat on every page */
        thead {
            display: table-header-group !important;
        }

        tfoot {
            display: table-footer-group !important;
        }

        /* Ultra-compact printing system to save paper */
        .table-excel {
            font-size: 0.65rem !important;
            border: 1px solid #000 !important;
            color: #000 !important;
        }

        .table-excel th,
        .table-excel td,
        .table-excel td *, 
        .table-excel th * {
            padding: 1px 2px !important;
            border: 1px solid #333 !important;
            color: #000 !important;
        }

        .table-excel th {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            background-color: #f8f9fc !important;
            color: #000 !important;
        }
        
        /* Force Deep Black for all ledger elements */
        .amount-debit, .amount-credit, .balance-positive, .balance-negative, .total-amount-val, .balance-amount-val, .item-desc, .item-math {
            color: #000 !important;
            font-weight: bold !important;
        }
        
        /* Ensure semi-headers stay visible in print */
        .txn-block-header, .table-excel tr.category-header td, .table-excel tr.road-header td {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            background-color: #4e73df !important;
            color: #fff !important;
        }
    }
</style>

<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-excel mb-0' . ($hover ? ' table-hover' : '')]) }}>
        <thead>
            @if (isset($print_header))
                <tr class="d-none d-print-table-row">
                    <th colspan="100" class="border-0 p-0 text-start bg-white text-dark">
                        {{ $print_header }}
                    </th>
                </tr>
            @endif
            {{ $thead }}
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
        @if (isset($tfoot))
            {{ $tfoot }}
        @endif
    </table>
</div>
