<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Real Estate - Order Confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Roboto+Slab:wght@400;600;700&display=swap');

        :root {
            --primary-green: #199e59;
            --light-green: #9ad65b;
            --dark-gray: #3c3c3c;
            --light-gray: #fafafa;
            --blue-bg: #cbe0ee;
            --white: #ffffff;
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* Animated Background Elements */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            animation: float 25s infinite ease-in-out;
            z-index: -1;
        }

        body::before {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
            animation-delay: 0s;
        }

        body::after {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -100px;
            animation-delay: 12s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        .email-container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            animation: slideUp 1s ease-out;
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

        /* Header Section */
        .email-header {
            background: linear-gradient(135deg, var(--light-green) 0%, var(--primary-green) 100%);
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 40s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .company-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 800;
            color: white;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 20px;
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .company-name {
            font-family: 'Roboto Slab', serif;
            font-size: 48px;
            font-weight: 700;
            color: white;
            text-shadow: 2px 4px 8px rgba(0,0,0,0.2);
            letter-spacing: -1px;
            margin-bottom: 16px;
            line-height: 1.1;
        }

        .company-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 30px;
        }

        .discover-btn {
            display: inline-block;
            background: var(--dark-gray);
            color: white;
            padding: 12px 40px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(60, 60, 60, 0.3);
        }

        .discover-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(60, 60, 60, 0.4);
            background: #2a2a2a;
        }

        /* Welcome Section */
        .welcome-section {
            background: white;
            padding: 60px 40px;
            text-align: center;
            position: relative;
        }

        .welcome-title {
            font-family: 'Roboto Slab', serif;
            font-size: 64px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        /* Order Details Section */
        .order-details {
            background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
            margin: 0 40px;
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            position: relative;
            overflow: hidden;
        }

        .order-details::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(135deg, var(--light-green) 0%, var(--primary-green) 100%);
        }

        .order-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .order-subtitle {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-green);
            margin-bottom: 30px;
        }

        .order-info {
            display: grid;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.06);
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--light-green) 0%, var(--primary-green) 100%);
        }

        .info-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .invoice-number {
            background: linear-gradient(135deg, var(--light-green) 0%, var(--primary-green) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 24px;
        }

        .read-more-btn {
            display: inline-block;
            background: var(--dark-gray);
            color: white;
            padding: 12px 40px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(60, 60, 60, 0.2);
        }

        .read-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(60, 60, 60, 0.3);
            background: #2a2a2a;
        }

        /* Footer Section */
        .email-footer {
            background: linear-gradient(135deg, var(--light-green) 0%, var(--primary-green) 100%);
            padding: 60px 40px 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .email-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at top right, rgba(255,255,255,0.1) 0%, transparent 50%);
        }

        .footer-content {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .footer-section p {
            font-size: 16px;
            line-height: 1.8;
            opacity: 0.9;
            text-align: center;
            margin-bottom: 8px;
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 14px;
            opacity: 0.8;
        }

        .bee-credit {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        .bee-credit a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .email-container {
                border-radius: 16px;
            }

            .email-header {
                padding: 40px 20px;
            }

            .company-name {
                font-size: 36px;
            }

            .welcome-title {
                font-size: 48px;
            }

            .welcome-section,
            .order-details {
                margin: 0 20px;
                padding: 30px 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .email-footer {
                padding: 40px 20px 20px;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .email-container {
                box-shadow: none;
                border: none;
                border-radius: 0;
            }

            .email-header::before,
            .email-footer::before,
            body::before,
            body::after {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <div class="header-content">
                <div class="company-logo">ER</div>
                <h1 class="company-name">Easy Real Estate</h1>
                <p class="company-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Enim nisl, eget dictum consectetur integer lectus.</p>
                <a href="http://www.example.com" class="discover-btn">Discover</a>
            </div>
        </div>

        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1 class="welcome-title">Welcome!</h1>
        </div>

        <!-- Order Details Section -->
        <div class="order-details">
            <h2 class="order-title">Hello Sir,</h2>
            <p class="order-subtitle">Your Request is confirmed on this date.</p>

            <div class="order-info">
                <div class="info-card">
                    <div class="info-label">Invoice Number</div>
                    <div class="info-value invoice-number">{{ $order['invoice_no'] }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Amount</div>
                    <div class="info-value">{{ $order['amount'] }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Name</div>
                    <div class="info-value">{{ $order['name'] }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $order['email'] }}</div>
                </div>
            </div>

            <div style="text-align: center;">
                <a href="http://www.example.com" class="read-more-btn">Read More</a>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About</h3>
                    <p>Lorem ipsum dolor sit amet, adipiscing.</p>
                    <p>Aenean eget scelerisque magna.</p>
                    <p>Cras interdum do mattis eugravid.</p>
                </div>

                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p>Your Street 12, 34567 AB City</p>
                    <p>info@example.com</p>
                    <p>(+1) 123 456 789</p>
                </div>
            </div>

            <div class="copyright">
                <p>2025 © All Rights Reserved</p>
            </div>
        </div>

        <!-- BEE Credit -->
        <div class="bee-credit">
            <a href="https://www.designedwithbee.com/" target="_blank" title="Designed with BEE">
                Designed with BEE
            </a>
        </div>
    </div>
</body>
</html>
