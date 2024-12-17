<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now - Ninja Pizza</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #dc1e1ee6;
            color: white;
        }
        .header-container {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        }
        .logo {
            font-size: 2rem;
        }
        .search-bar {
            padding: 10px;
            border-radius: 5px;
            width: 50%;
            margin-right: 20px;
        }
        .nav-links {
            list-style-type: none;
            display: flex;
            align-items: center;
        }
        .nav-links li {
            margin-left: 20px;
        }
        .main-content {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #891717;
            padding: 20px;
        }
        .sidebar h2 {
            margin-top: 0;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #900b0b;
        }
        .order-categories {
            flex-grow: 1;
            padding: 20px;
            background: linear-gradient(to bottom right, #b62020, #000);
        }
        .category-boxes {
            display: flex;
            flex-wrap: wrap;
        }
        .box {
            background-color: #900b0b;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
        }

        .box1 {
            background-color: #900b0b;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
        }

        .box2 {
            background-color: #900b0b;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
        }

        .box3 {
            background-color: #900b0b;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
        }

        .box4 {
            background-color: #900b0b;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
        }

        .box5 {
            background: url("images/bswrm.jpg");
            background-size: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            height: 300px;
        }

        .box6 {
            background: url("images/hac.jpg");
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            height: 300px;
        }

        .box7 {
            background: url("images/sh.jpg");
            background-size: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            height: 300px;
        }

        .box8 {
            background: url("images/ctm.jpg");
            background-size: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            height: 300px;
        }

        .box9 {
            background: url("images/hd.jpg");
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            height: 300px;
        }

        .box10 {
            background: url("images/cs.jpg");
            background-size: 550px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            height: 300px;
        }

        .box11 {
            background: url("image/pp.jpg");
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            height: 300px;
        }

        .box12{
            background: url("images/cp.jpg");
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            height: 300px;
        }

        .box h3 {
            color: #ff5733;
        }
        footer {
            text-align: center; 
            padding: 10px; 
           background-color:#333; 
           color:white; 
           position:absolute; 
           width :100%; 
       }

       
       #cart-modal, #purchases-modal {
           display:none; 
           position :fixed; 
           z-index :1000; 
           left :0; 
           top :0; 
           width :100%; 
           height :100%; 
           overflow:auto; 
           background-color :rgba(0,0,0,0.4);
       } 
       .cart-content, .purchases-content { 
          background-color:#fff; 
          margin:auto; 
          padding :20px ; 
          border-radius :10px ; 
          width :80%; 
          max-width :600px ; 
       } 
       .cart-item { 
          display:flex ; 
          justify-content :space-between ; 
          align-items:center ; 
       } 
       .cart-item input[type=number] { 
          width :50px ; 
          margin-left :10px ; 
       } 
       .box ingridient-box {
        color: #ff5733;

       }

       @media (max-width: 768px) {
    .category-boxes {
        flex-direction: column;
    }

    .box {
        width: 100%;
    }
}

    </style>
</head>
<body>
<header class="header">
    <div class="header-container">
        <h1 class="logo">Ninja Pizza</h1>
        
        
        <input type="text" class="search-bar" placeholder="Search...">
        
        
        <nav>
           <ul class="nav-links">
               
               <li><a href="index.php" class="nav-link"><i class="fa fa-home"></i> Home</a></li>
               
               <li><a href="#" class="cart-icon" onclick="showCart()"><i class="fa fa-shopping-cart"></i> Cart (<span id="cart-total-header">₱0.00</span>)</a></li>
               
               <li><a href="#" class="nav-link" onclick="showPurchases()">My Purchases</a></li>
           </ul>
       </nav>
    </div>
</header>

<main class="main-content">
    <aside class="sidebar">
       <h2>Account</h2>
       
       <a href="#notifications">Notifications</a>
       <a href="to-ship.php">To Ship</a>
       <a href="#delivered">Delivered</a>
    </aside>

        <!-- Popup for "Added to Cart" message -->
<div id="added-to-cart-popup" style="display: none; position: fixed; z-index: 1000; top: 20px; right: 20px; background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; font-size: 16px;">
    Added to Cart!
</div>

    <section class="order-categories">
       <h2>Supplies</h2>
       <div class="category-boxes">
           
           <div class="box1 ingredient-box">
               <h3>Pizza Sauce (per kg)</h3>
               <p>Price: ₱200</p>
               <button onclick="addToCart('Pizza Sauce', 200)">Add to Cart</button>
           </div>

           <div class="box2 ingredient-box">
               <h3>Dough Size 10 (min 50 pcs)</h3>
               <p>Price: ₱500</p>
               <button onclick="addToCart('Dough Size 10', 500)">Add to Cart</button>
           </div>

           <div class="box3 ingredient-box">
               <h3>Pizza Box Size 10' (min 50 pcs)</h3>
               <p>Price: ₱250</p>
               <button onclick="addToCart('Pizza Box Size 10', 250)">Add to Cart</button>
           </div>

           <div class="box4 ingredient-box">
               <h3>Mozzarella (/KG)</h3>
               <p>Price: ₱80</p>
               <button onclick="addToCart('Mozzarella', 80)">Add to Cart</button>
           </div>

       </div>

       <h2>Ready to Cook Pizza</h2>
       <div class="category-boxes">
           
           <div class="box5 pizza-box">
               <h3>Shawarma Attack 10'</h3>
               <p>Price: ₱99</p>
               <button onclick="addToCart('Shawarma Attack', 99)">Add to Cart</button>
           </div>

           <div class="box6 ingredient-box">
               <h3>Ham & Cheese 10'</h3>
               <p>Price: ₱79</p>
               <button onclick="addToCart('Ham & Cheese', 79)">Add to Cart</button>
           </div>
            <div class="box7 ingredient-box">
               <h3>Sisig Heaven 10'</h3>
               <p>Price: ₱89</p>
               <button onclick="addToCart('MozSisig Heaven 10', 89)">Add to Cart</button>
           </div>
           <div class="box8 ingredient-box">
            <h3>Creamy Tuna Mayo 10'</h3>
            <p>Price: ₱89</p>
            <button onclick="addToCart('Creamy Tuna Mayo 10', 89)">Add to Cart</button>
        </div>
        <div class="box9 ingredient-box">
            <h3>Hawaiian Delights 11'</h3>
            <p>Price: ₱89</p>
            <button onclick="addToCart('Hawaiian Delights 11', 89)">Add to Cart</button>
        </div>
        <div class="box10 ingredient-box">
            <h3>Choco S'mores 11'</h3>
            <p>Price: ₱99</p>
            <button onclick="addToCart('Hawaiian Delights 11', 99)">Add to Cart</button>
        </div>
        <div class="box11 ingredient-box">
            <h3>Pepperoni 11'</h3>
            <p>Price: ₱99</p>
            <button onclick="addToCart('Choco Smores 11', 99)">Add to Cart</button>
        </div>
        <div class="box12 ingredient-box">
            <h3>Cheezy Pizza 11'</h3>
            <p>Price: ₱99</p>
            <button onclick="addToCart('Pepperoni 11', 99)">Add to Cart</button>
        </div>

       </div>

       
       <section id="payment-section" class="payment-section">
           <h2>Proceed to Payment</h2>
           <p>Total Amount Due:</p><span id="total-price">₱0.00</span>

           
           ...
           
           <button onclick="notifyPayment()">Notify Payment</button>

           <button onclick="proceedToPayment()">Proceed to Payment</button>

       </section>

    </section>

    <div id="cart-modal">
       <div class="cart-content">
          <h2>Your Cart</h2>
          <div id="cart-items"></div> 
          <p>Total Price:<span id="cart-total">₱0.00</span></p> 

          <button onclick="proceedToPayment()">Proceed to Payment</button>
          <button onclick="closeCart()">Close Cart</button>
       </div>
    </div>

    <div id="purchases-modal">
       <div class="purchases-content">
          <h2>Your Purchases</h2>
          <div id="purchase-items"></div> 

          <button onclick="closePurchases()">Close Purchases</button>
       </div>
    </div>

</main>

   <p>&copy;2024 Ninja Pizza. All rights reserved.</p> 
   <p>Email: ninjapizza@gmail.com | Phone: +639603117943</p> 
</footer>

<script>
let cart = [];
let total = 0;
    

// Add to cart with AJAX
function addToCart(item, price) {
    const existingItem = cart.find(cartItem => cartItem.item === item);
    if (existingItem) {
        existingItem.quantity++;
        existingItem.totalPrice += price;
    } else {
        cart.push({ item, price, quantity: 1, totalPrice: price });
    }
    updateCart();
    updateCartTotal();  // Update the cart total
}

// Update cart display using AJAX (no page reload)
function updateCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = ''; 
    total = cart.reduce((acc, curr) => acc + curr.totalPrice, 0); 

    cart.forEach(cartItem => {
         const itemDiv = document.createElement('div');
         itemDiv.className = 'cart-item';
         itemDiv.innerHTML = `
             ${cartItem.item} (₱${cartItem.price}) x
             <input type='number' value='${cartItem.quantity}' min='1' onchange='updateQuantity("${cartItem.item}", this.value)'/> =
             ₱${cartItem.totalPrice.toFixed(2)}
             <button onclick="removeFromCart('${cartItem.item}')">Remove</button>
         `;
         cartItemsContainer.appendChild(itemDiv);
     });

     document.getElementById('cart-total').innerText = `₱${total.toFixed(2)}`;
     document.getElementById('total-price').innerText = `₱${total.toFixed(2)}`;
     document.getElementById('cart-total-header').innerText = `₱${total.toFixed(2)}`;
}

// Update cart total on the backend using AJAX
function updateCartTotal() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Cart updated');
        }
    };
    xhr.send('total=' + total); // Send the updated total to the server
}

// Remove item from cart
function removeFromCart(item) {
    cart = cart.filter(cartItem => cartItem.item !== item);
    updateCart();
    updateCartTotal();  // Update the cart total
}
{
     document.getElementById('cart-total').innerText = `₱${total.toFixed(2)}`; 
     document.getElementById('total-price').innerText = `₱${total.toFixed(2)}`; 
     document.getElementById('cart-total-header').innerText = `₱${total.toFixed(2)}`; 
}

function updateQuantity(itemName, quantity) {
    const cartItem = cart.find(item => item.item === itemName);
    if (cartItem) {
         const oldQuantity = cartItem.quantity;
         cartItem.quantity = parseInt(quantity);
         cartItem.totalPrice = (cartItem.price * cartItem.quantity); 
         total += (cartItem.totalPrice - (oldQuantity * cartItem.price)); 
         updateCart(); 
     }
}

function showCart() {
     document.getElementById('cart-modal').style.display = 'block'; 
}

function closeCart() {
     document.getElementById('cart-modal').style.display = 'none'; 
}

function showPurchases() {
     const purchaseItemsContainer = document.getElementById('purchase-items');
     purchaseItemsContainer.innerHTML = ''; 

     if (cart.length > 0) {
         cart.forEach(cartItem => {
             const purchaseDiv = document.createElement('div');
             purchaseDiv.className = 'purchase-item';
             purchaseDiv.innerHTML = `${cartItem.item} - Quantity:${cartItem.quantity} - Total Price:${cartItem.totalPrice.toFixed(2)}`;
             purchaseItemsContainer.appendChild(purchaseDiv);
         });
     } else {
         purchaseItemsContainer.innerHTML = '<p>No purchases made yet.</p>';
     }

     document.getElementById('purchases-modal').style.display = 'block'; 
}

function closePurchases() {
     document.getElementById('purchases-modal').style.display = 'none';
}

function submitProof() {
     const proof = document.getElementById('proof-upload').files[0];
     if (proof) {
         alert('Proof of payment submitted!'); 
     }
}

function notifyPayment() {
     alert('Your payment has been notified!');
}

function proceedToPayment() {
     if (total > 0) {
         alert(`Proceeding to payment with total amount of ₱${total.toFixed(2)}`);
     } else {
         alert("Your cart is empty! Add items before proceeding.");
     }
}
// Add to cart with AJAX
function addToCart(item, price) {
    const existingItem = cart.find(cartItem => cartItem.item === item);
    if (existingItem) {
        existingItem.quantity++;
        existingItem.totalPrice += price;
    } else {
        cart.push({ item, price, quantity: 1, totalPrice: price });
    }
    updateCart();
    updateCartTotal();  // Update the cart total

    // Show "Added to Cart" message
    showAddedToCartPopup();
}

// Show "Added to Cart" popup
function showAddedToCartPopup() {
    const popup = document.getElementById('added-to-cart-popup');
    popup.style.display = 'block';

    // Hide the popup after 3 seconds
    setTimeout(function() {
        popup.style.display = 'none';
    }, 3000); // 3 seconds delay
}

// Proceed to Payment Function
function proceedToPayment() {
    if (total > 0) {
        // Confirm with the user before proceeding
        const confirmPayment = confirm(`Your total amount is ₱${total.toFixed(2)}. Do you want to proceed with the payment?`);

        if (confirmPayment) {
            // Simulate payment process (e.g., calling a payment API)
            processPayment();
        } else {
            alert("Payment cancelled.");
        }
    } else {
        alert("Your cart is empty! Add items before proceeding.");
    }
}

// Proceed to Payment Function
function proceedToPayment() {
    if (total > 0) {
        // Confirm with the user before proceeding
        const confirmPayment = confirm(`Your total amount is ₱${total.toFixed(2)}. Do you want to proceed with the payment?`);

        if (confirmPayment) {
            // Simulate payment process (e.g., calling a payment API)
            processPayment();
        } else {
            alert("Payment cancelled.");
        }
    } else {
        alert("Your cart is empty! Add items before proceeding.");
    }
}

// Simulate payment processing
function processPayment() {
    // Show a loading message or spinner if needed
    alert(`Processing payment for ₱${total.toFixed(2)}...`);

    // Simulate a successful payment after a delay (e.g., mock API call)
    setTimeout(function() {
        // Payment success
        alert("Payment Successful! Thank you for your purchase.");

        // After payment, clear the cart
        cart = []; // Empty the cart
        total = 0; // Reset total
        updateCart(); // Update cart display
        updateCartTotal(); // Update cart total

        // Close the cart after successful payment
        document.getElementById("cart-section").style.display = "none";

        // Optionally, you can redirect the user to a success page, or show them a summary
        // For now, we just show a simple success message and reset the cart
    }, 2000); // Simulate a 2-second payment delay
}

</script>

</body>
</html>