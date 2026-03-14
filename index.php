<?php 
session_start(); 
include('php/db_connection.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f8f9fa;
            --primary-color: #28a745;
            --secondary-color: #ffc107;
            --button-color: #007bff;
            --font-color: #333;
            --keypad-bg: #ffffff;
            --keypad-button: #f8f9fa;
            --keypad-hover: #e9ecef;
            --keypad-active: #007bff;
        }
        
        body {
            background: linear-gradient(135deg, var(--bg-color) 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--font-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }
        
        .main-container {
            display: flex;
            gap: 30px;
            align-items: stretch;
            max-width: 900px;
            width: 100%;
        }
        
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            flex-shrink: 0;
        }
        
        .keypad-container {
            background: var(--keypad-bg);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 30px;
            width: 350px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .keypad-header {
            text-align: center;
            margin-bottom: 25px;
            color: var(--font-color);
        }
        
        .keypad-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .keypad-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .keypad-btn {
            background: var(--keypad-button);
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--font-color);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 70px;
            user-select: none;
        }
        
        .keypad-btn:hover {
            background: var(--keypad-hover);
            border-color: #dee2e6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .keypad-btn:active {
            background: var(--keypad-active);
            color: white;
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(0,123,255,0.3);
        }
        
        .keypad-2col {
            grid-column: span 2;
        }
        
        .keypad-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .keypad-action-btn {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            border-radius: 15px;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 60px;
        }
        
        .keypad-action-btn.clear-btn {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        }
        
        .keypad-action-btn.enter-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        
        .keypad-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }
        
        .keypad-action-btn:active {
            transform: translateY(0);
        }
        
        .password-display {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1.2rem;
            text-align: center;
            margin-bottom: 20px;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            letter-spacing: 3px;
            font-family: monospace;
            color: var(--font-color);
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #20c997 100%);
            color: white;
            padding: 40px 30px 30px;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        
        .login-header h2 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }
        
        .login-header .subtitle {
            margin-top: 10px;
            opacity: 0.9;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--font-color);
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 120px;
            flex-shrink: 0;
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            flex: 1;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            background: white;
            outline: none;
        }
        
        .form-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px 12px;
            padding-right: 40px;
        }
        
        .login-btn {
            background: linear-gradient(135deg, var(--button-color) 0%, #0056b3 100%);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.3);
        }
        
        .login-btn:active {
            transform: translateY(0);
        }
        
        .error-message {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-top: 20px;
            border-left: 4px solid #a71e2a;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .icon-wrapper {
            width: 20px;
            text-align: center;
        }
        
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape1 {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: rgba(40, 167, 69, 0.1);
            animation-delay: 0s;
        }
        
        .shape2 {
            top: 70%;
            right: 10%;
            width: 120px;
            height: 120px;
            background: rgba(0, 123, 255, 0.1);
            animation-delay: 2s;
        }
        
        .shape3 {
            bottom: 20%;
            left: 20%;
            width: 60px;
            height: 60px;
            background: rgba(255, 193, 7, 0.1);
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }
            
            .keypad-container {
                width: 100%;
                max-width: 350px;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .login-container {
                border-radius: 15px;
            }
            
            .keypad-container {
                border-radius: 15px;
                padding: 20px;
            }
            
            .login-header {
                padding: 30px 20px 20px;
            }
            
            .login-header h2 {
                font-size: 2rem;
            }
            
            .login-body {
                padding: 30px 20px;
            }
            
            .keypad-btn {
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>
    
    <div class="main-container">
        <!-- Login Form -->
        <div class="login-container">
            <div class="login-header">
                <h2><i class="fas fa-lock"></i> LOGIN</h2>
                <div class="subtitle">Welcome back! Please sign in to continue</div>
            </div>
            
            <div class="login-body">
                <form action="php/login_process.php" method="POST" id="loginForm">
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <span class="icon-wrapper"><i class="fas fa-user"></i></span>
                            Username
                        </label>
                        <select name="username" id="username" class="form-select" required>
                            <option value="">-- Choose username --</option>
                            <?php 
                                $sql = "SELECT username FROM users";
                                $stmt = $pdo->query($sql); 
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if ($rows) { 
                                    foreach ($rows as $row) { 
                                        echo '<option value="' . htmlspecialchars($row['username']) . '">' . htmlspecialchars($row['username']) . '</option>'; 
                                    } 
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <span class="icon-wrapper"><i class="fas fa-key"></i></span>
                            Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Use keypad to enter password" required readonly>
                    </div>
                    
                    <button type="submit" class="login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        login
                    </button>
                    
                    <?php 
                    if (isset($_SESSION['error_message'])){ 
                        echo '<div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                '. $_SESSION['error_message'] .'
                              </div>'; 
                        unset($_SESSION['error_message']); 
                    } 
                    ?>
                </form>
            </div>
        </div>
        
        <!-- Numeric Keypad -->
        <div class="keypad-container">
            <div class="keypad-content">
                <div class="keypad-grid">
                    <button class="keypad-btn" onclick="addDigit('1')">1</button>
                    <button class="keypad-btn" onclick="addDigit('2')">2</button>
                    <button class="keypad-btn" onclick="addDigit('3')">3</button>
                    <button class="keypad-btn" onclick="addDigit('4')">4</button>
                    <button class="keypad-btn" onclick="addDigit('5')">5</button>
                    <button class="keypad-btn" onclick="addDigit('6')">6</button>
                    <button class="keypad-btn" onclick="addDigit('7')">7</button>
                    <button class="keypad-btn" onclick="addDigit('8')">8</button>
                    <button class="keypad-btn" onclick="addDigit('9')">9</button>
                    <button class="keypad-btn keypad-2col" onclick="addDigit('0')">0</button>
                    <button class="keypad-btn" onclick="backspace()"><i class="fas fa-backspace"></i></button>
                </div>
                
                <div class="keypad-actions">
                    <button class="keypad-action-btn clear-btn keypad-2col" onclick="clearPassword()">
                        <i class="fas fa-times"></i> Clear
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        
        let currentPassword = '';

        function updateDisplay() {
          document.getElementById('password').value = '•'.repeat(currentPassword.length);
        }

        function addDigit(digit) {
          currentPassword += digit;
          updateDisplay();
        }

        function backspace() {
          currentPassword = currentPassword.slice(0, -1);
          updateDisplay();
        }

        function clearPassword() { 
          currentPassword = '';
          updateDisplay();
        }

        function submitForm() {
          const username = document.getElementById('username').value;

          if (!currentPassword) {
            alert('Please enter your password using the keypad');
            return;
          }

          if (!username) {
            alert('Please select a username');
            document.getElementById('username').focus();
            return;
          }

          // Put the real password in the hidden field and submit
          document.getElementById('password').value = currentPassword;
          document.getElementById('loginForm').submit();
        }

        // Listen for physical keyboard keys (digits, backspace, enter, escape)
        document.addEventListener('keydown', e => {
          if (document.activeElement.tagName === 'SELECT') return;

          if (e.key >= '0' && e.key <= '9') {
            e.preventDefault();
            addDigit(e.key);
          } else if (e.key === 'Backspace') {
            e.preventDefault();
            backspace();
          } else if (e.key === 'Enter') {
            e.preventDefault();
            submitForm();
          } else if (e.key === 'Escape') {
            e.preventDefault();
            clearPassword();
          }
        });

        // Prevent default form submit to handle password properly
        document.getElementById('loginForm').addEventListener('submit', e => {
          e.preventDefault();
          document.getElementById('password').value = currentPassword;
          e.target.submit();
        });

        clearPassword(); // Initialize display
    </script>
</body>
</html>