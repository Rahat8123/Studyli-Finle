<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --green-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --success: #48bb78;
            --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-xl: 0 35px 60px -12px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--primary-gradient);
            min-height: 100vh;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Elements */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
            z-index: -1;
        }

        body::before {
            width: 400px;
            height: 400px;
            top: -200px;
            right: -200px;
            animation-delay: 0s;
        }

        body::after {
            width: 300px;
            height: 300px;
            bottom: -150px;
            left: -150px;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            position: relative;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Glassmorphism Header */
        .invoice-header {
            background: var(--green-gradient);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .invoice-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .header-content {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 40px;
            align-items: start;
        }

        .company-brand {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 800;
            color: white;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .company-name {
            font-size: 36px;
            font-weight: 800;
            color: white;
            text-shadow: 2px 4px 8px rgba(0,0,0,0.2);
            letter-spacing: -0.5px;
        }

        .company-details {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 14px;
            line-height: 1.6;
            font-weight: 400;
        }

        /* Main Content */
        .invoice-body {
            padding: 40px;
        }

        /* Customer & Invoice Info Cards */
        .info-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-card {
            background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--green-gradient);
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(72, 187, 120, 0.2);
        }

        .info-line {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
            color: var(--text-secondary);
            transition: all 0.2s ease;
        }

        .info-line:hover {
            color: var(--text-primary);
            transform: translateX(5px);
        }

        .info-label {
            font-weight: 600;
            color: var(--text-primary);
            min-width: 80px;
            margin-right: 10px;
        }

        .invoice-number {
            font-size: 28px;
            font-weight: 800;
            background: var(--green-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        /* Products Section */
        .products-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 24px;
            position: relative;
            padding-left: 20px;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: var(--green-gradient);
            border-radius: 2px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            background: white;
        }

        .products-table thead {
            background: var(--dark-gradient);
            color: white;
        }

        .products-table th {
            padding: 20px 16px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .products-table tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
        }

        .products-table tbody tr:hover {
            background: linear-gradient(90deg, #f0fff4 0%, #f7fafc 100%);
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .products-table tbody tr:last-child {
            border-bottom: none;
        }

        .products-table td {
            padding: 20px 16px;
            text-align: center;
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .product-image {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .product-image:hover {
            transform: scale(1.1) rotate(2deg);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        /* Advanced Totals Section */
        .totals-section {
            background: linear-gradient(145deg, #1a202c 0%, #2d3748 100%);
            color: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .totals-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.2); opacity: 0.1; }
        }

        .totals-content {
            position: relative;
            z-index: 2;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding: 12px 0;
            font-size: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .total-line:last-child {
            border-bottom: 2px solid rgba(72, 187, 120, 0.3);
            margin-bottom: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .total-label {
            font-weight: 600;
            opacity: 0.9;
        }

        .total-amount {
            font-weight: 700;
            background: var(--green-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Footer Section */
        .footer-section {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 40px;
            align-items: end;
            padding: 30px;
            background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 20px;
            margin-top: 20px;
        }

        .thanks {
            position: relative;
        }

        .thanks p {
            font-size: 20px;
            font-weight: 600;
            background: var(--green-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-style: italic;
        }

        /* Digital Signature */
        .authority {
            background: white;
            padding: 25px;
            border-radius: 16px;
            border: 2px dashed var(--success);
            text-align: center;
            position: relative;
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
        }

        .signature-area {
            width: 180px;
            height: 60px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            margin: 0 auto 15px;
            background: linear-gradient(45deg, #f8fafc 25%, transparent 25%),
                        linear-gradient(-45deg, #f8fafc 25%, transparent 25%),
                        linear-gradient(45deg, transparent 75%, #f8fafc 75%),
                        linear-gradient(-45deg, transparent 75%, #f8fafc 75%);
            background-size: 10px 10px;
            background-position: 0 0, 0 5px, 5px -5px, -5px 0px;
            position: relative;
            overflow: hidden;
        }

        .signature-area::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            color: var(--success);
            opacity: 0.3;
        }

        .authority h5 {
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .invoice-container {
                border-radius: 16px;
            }

            .invoice-header {
                padding: 30px 20px;
            }

            .header-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .company-details {
                text-align: left;
            }

            .invoice-body {
                padding: 30px 20px;
            }

            .info-cards {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .footer-section {
                grid-template-columns: 1fr;
                gap: 20px;
                text-align: center;
            }

            .products-table {
                font-size: 12px;
            }

            .products-table th,
            .products-table td {
                padding: 12px 8px;
            }

            .company-name {
                font-size: 28px;
            }

            .invoice-number {
                font-size: 24px;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none;
                border: none;
                border-radius: 0;
            }

            .invoice-header::before,
            .totals-section::before,
            body::before,
            body::after {
                display: none;
            }
        }
    </style>
  </head>
  <body>
    <div class="invoice-container">
      <!-- Advanced Header with Glassmorphism -->
      <div class="invoice-header">
        <div class="header-content">
          <div class="company-brand">
            <div class="company-logo">ES</div>
            <div class="company-name">EasyShop</div>
          </div>
          <div class="company-details">
            <strong>EasyShop Head Office</strong><br>
            Email: support@easylearningbd.com<br>
            Mobile: 1245454545<br>
            Dhaka 1207, Dhanmondi: #4
          </div>
        </div>
      </div>

      <!-- Advanced Body Section -->
      <div class="invoice-body">
        <!-- Customer and Invoice Info Cards -->
        <div class="info-cards">
          <div class="info-card">
            <div class="card-title">Bill To</div>
            <div class="info-line">
              <span class="info-label">Name:</span>
              <span>{{ $payment->name }}</span>
            </div>
            <div class="info-line">
              <span class="info-label">Email:</span>
              <span>{{ $payment->email }}</span>
            </div>
            <div class="info-line">
              <span class="info-label">Phone:</span>
              <span>{{ $payment->phone }}</span>
            </div>
            <div class="info-line">
              <span class="info-label">Address:</span>
              <span>{{ $payment->address }}</span>
            </div>
          </div>

          <div class="info-card">
            <div class="invoice-number">INVOICE #{{ $payment->invoice_no }}</div>
            <div class="info-line">
              <span class="info-label">Order Date:</span>
              <span>{{ $payment->order_date }}</span>
            </div>
            <div class="info-line">
              <span class="info-label">Delivery:</span>
              <span>{{ $payment->order_date }}</span>
            </div>
            <div class="info-line">
              <span class="info-label">Payment:</span>
              <span>{{ $payment->payment_type }}</span>
            </div>
          </div>
        </div>

        <!-- Advanced Products Section -->
        <div class="products-section">
          <div class="section-title">Products & Services</div>
          <table class="products-table">
            <thead>
              <tr>
                <th>Image</th>
                <th>Course Name</th>
                <th>Unit Price</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orderItem as $item)
              <tr>
                <td>
                  <img src="{{ public_path($item->course->course_image) }}"
                       height="60px" width="60px" alt="Course" class="product-image">
                </td>
                <td style="font-weight: 600; color: var(--text-primary);">
                  {{ $item->course->course_name }}
                </td>
                <td style="font-weight: 600;">{{ $item->price }} Tk</td>
                <td style="font-weight: 700; color: var(--success);">{{ $item->price }} Tk</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Advanced Totals Section -->
        <div class="totals-section">
          <div class="totals-content">
            <div class="total-line">
              <span class="total-label">Subtotal</span>
              <span class="total-amount">{{ $payment->total_amount }} Tk</span>
            </div>
            <div class="total-line">
              <span class="total-label">Total Amount</span>
              <span class="total-amount">{{ $payment->total_amount }} Tk</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Advanced Footer Section -->
      <div class="footer-section">
        <div class="thanks">
          <p>Thank you for choosing sTUDYLI!</p>
        </div>

        <div class="authority">
          <div class="signature-area"></div>
          <h5>Authority Signature</h5>
        </div>
      </div>
    </div>
  </body>
</html>
