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
  <title>Pizza Inventory System</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="try1.php">
</head>
<body>
  <div class="container">
    <header>
      <h1>Pizza Inventory Management</h1>
    </header>
    

    <main>
        <section class="sales-statistics-section">
            <h3>Sales Statistics</h3>
            <table id="salesTable">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Units Sold</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          
            <div class="chart-container">
              <canvas id="salesChart"></canvas>
            </div>
          </section>

      <!-- Inventory Table -->
      <section class="inventory-section">
        <h2>Current Inventory</h2>
        <table id="inventoryTable">
          <thead>
            <tr>
              <th>Category</th>
              <th>Stock</th>
              <th>Critical Level</th>
              <th>Status</th>
              <th>Reduce Stock</th>
              <th>Add Stock</th>
            </tr>
          </thead>
          
          <tbody>
           
          </tbody>
        </table>
      </section>

 
      <section class="add-stock-section">
        <h2>Stock Addition</h2>
        <table id="addStockTable">
          <thead>
            <tr>
              <th>Category</th>
              <th>Add Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
           
          </tbody>
        </table>
      </section>

      
      <section class="link-container">

         <button id="simulateCartButton" class="btn">Simulate Cart Update</button>
      </section>
    </main>

    <div id="notification" class="notification"></div>
  </div>
  
</body>
</html>
<style>

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(to bottom, #550000, #1a0000);
  margin: 0;
  padding: 0;
  color: #f1f1f1;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

header {
  text-align: center;
  margin-bottom: 40px;
  background: linear-gradient(to right, #990000, #330000);
  padding: 20px;
  border-radius: 8px;
  color: white;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
}

header h1 {
  font-size: 2.5rem;
}


.inventory-section {
  background: linear-gradient(to bottom, #770000, #220000);
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
}

.inventory-section h2 {
  margin-bottom: 15px;
  color: #ffcccc;
}

/* Table */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

table th, table td {
  border: 1px solid #550000;
  padding: 10px;
  text-align: center;
}

table th {
  background: linear-gradient(to right, #cc0000, #660000);
  color: white;
}

table tr:nth-child(even) {
  background-color: #330000;
}

table tr:nth-child(odd) {
  background-color: #440000;
}

table td {
  color: #f1f1f1;
}

/* Buttons */
table button {
  padding: 5px 10px;
  background: linear-gradient(to right, #ff4d4d, #990000);
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

table button:hover {
  background: linear-gradient(to right, #ff0000, #660000);
}

/* Notification */
.notification {
  margin-top: 20px;
  padding: 15px;
  color: white;
  background: linear-gradient(to right, #ff0000, #550000);
  text-align: center;
  border-radius: 5px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5);
  display: none;
}

/* Add Stock Section */
.add-stock-section {
  background: linear-gradient(to bottom, #880000, #330000);
  padding: 20px;
  margin-top: 30px;
  border-radius: 8px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
}

.add-stock-section h2 {
  color: #ffcccc;
}

.link-container {
  text-align: center;
  margin-top: 30px;
}

.link-container button {
  padding: 10px 20px;
  background: linear-gradient(to right, #ff4d4d, #990000);
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}

.link-container button:hover {
  background: linear-gradient(to right, #ff0000, #660000);
}

.sales-statistics-section {
  margin-top: 40px;
  background: linear-gradient(to bottom, #770000, #220000);
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
}

.sales-statistics-section h3 {
  margin-bottom: 20px;
  color: #ffcccc;
  font-size: 1.8rem;
}

.sales-statistics-section table {
  width: 100%;
  margin-top: 20px;
  border-collapse: collapse;
}

.sales-statistics-section table th,
.sales-statistics-section table td {
  border: 1px solid #550000;
  padding: 10px;
  text-align: center;
}

.sales-statistics-section table th {
  background: linear-gradient(to right, #cc0000, #660000);
  color: white;
}

.sales-statistics-section table tr:nth-child(even) {
  background-color: #330000;
}

.sales-statistics-section table tr:nth-child(odd) {
  background-color: #440000;
}

.sales-statistics-section table td {
  color: #f1f1f1;
}

.top-selling {
  color: green;
  font-weight: bold;
}

.low-selling {
  color: red;
  font-weight: bold;
}

.chart-container {
  margin-top: 30px;
  background: #220000;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
}

.chart-container canvas {
  width: 100%;
  height: 350px;
  border-radius: 8px;
}
.sales-statistics-section {
  background: linear-gradient(to bottom, #880000, #330000);
  padding: 20px;
  border-radius: 8px;
  margin-bottom: 30px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
}
.sales-statistics-section h3 {
  color: #ffcccc;
  margin-bottom: 15px;
}
.inventory-section, .add-stock-section {
  opacity: 1;
  transition: opacity 0.5s ease-in-out;
}
</style>


<script>
document.addEventListener('DOMContentLoaded', () => {
  const inventory = [
    { category: 'Dough', stock: 50, criticalLevel: 10 },
    { category: 'Cheese', stock: 30, criticalLevel: 5 },
    { category: 'Tomato Sauce', stock: 40, criticalLevel: 8 },
    { category: 'Pepperoni', stock: 25, criticalLevel: 5 },
    { category: 'Vegetables', stock: 20, criticalLevel: 5 }
  ];

  const salesData = [
    { product: 'Dough', sold: 120 },
    { product: 'Cheese', sold: 95 },
    { product: 'Tomato Sauce', sold: 110 },
    { product: 'Pepperoni', sold: 150 },
    { product: 'Vegetables', sold: 75 }
  ];

  const salesTable = document.getElementById('salesTable').querySelector('tbody');
  const salesChartCanvas = document.getElementById('salesChart');
  const inventoryTable = document.getElementById('inventoryTable').querySelector('tbody');
  const addStockTable = document.getElementById('addStockTable').querySelector('tbody');
  const notification = document.getElementById('notification');
  let salesChart;

  function loadSalesData() {
    salesTable.innerHTML = '';
    salesData.forEach(item => {
      const row = document.createElement('tr');

      const productCell = document.createElement('td');
      productCell.textContent = item.product;

      const soldCell = document.createElement('td');
      soldCell.textContent = item.sold;

      const statusCell = document.createElement('td');
      statusCell.textContent = item.sold > 100 ? 'Top Selling' : 'Normal';
      statusCell.className = item.sold > 100 ? 'top-selling' : 'low-selling';

      row.appendChild(productCell);
      row.appendChild(soldCell);
      row.appendChild(statusCell);

      salesTable.appendChild(row);
    });

    updateChart();
  }

  function updateChart() {
    const labels = salesData.map(item => item.product);
    const data = salesData.map(item => item.sold);

    if (salesChart) salesChart.destroy(); 

    salesChart = new Chart(salesChartCanvas, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Units Sold',
          data: data,
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top'
          },
          tooltip: {
            callbacks: {
              label: context => `${context.raw} units`
            }
          }
        }
      }
    });
  }

  function loadInventory() {
    inventoryTable.innerHTML = '';
    inventory.forEach((item, index) => {
      const row = document.createElement('tr');

      const categoryCell = document.createElement('td');
      categoryCell.textContent = item.category;

      const stockCell = document.createElement('td');
      stockCell.textContent = item.stock;

      const criticalCell = document.createElement('td');
      criticalCell.textContent = item.criticalLevel;

      const statusCell = document.createElement('td');
      const isCritical = item.stock <= item.criticalLevel;
      statusCell.textContent = isCritical ? 'Critical' : 'Normal';
      statusCell.style.color = isCritical ? 'red' : 'green';

      const reduceCell = document.createElement('td');
      const reduceButton = document.createElement('button');
      reduceButton.textContent = 'Reduce';
      reduceButton.addEventListener('click', () => reduceStock(index));
      reduceCell.appendChild(reduceButton);

      const addCell = document.createElement('td');
      const addButton = document.createElement('button');
      addButton.textContent = 'Add Stock';
      addButton.addEventListener('click', () => addStock(index));
      addCell.appendChild(addButton);

      row.appendChild(categoryCell);
      row.appendChild(stockCell);
      row.appendChild(criticalCell);
      row.appendChild(statusCell);
      row.appendChild(reduceCell);
      row.appendChild(addCell);

      inventoryTable.appendChild(row);
    });
    loadAddStockTable();
  }

  function loadAddStockTable() {
    addStockTable.innerHTML = '';
    inventory.forEach((item, index) => {
      const row = document.createElement('tr');
      const categoryCell = document.createElement('td');
      categoryCell.textContent = item.category;

      const quantityCell = document.createElement('td');
      const quantityInput = document.createElement('input');
      quantityInput.type = 'number';
      quantityInput.min = 1;
      quantityInput.value = 1;
      quantityInput.dataset.index = index;
      quantityCell.appendChild(quantityInput);

      const actionCell = document.createElement('td');
      const addButton = document.createElement('button');
      addButton.textContent = 'Add';
      addButton.addEventListener('click', () => {
        const quantity = parseInt(quantityInput.value, 10);
        if (!isNaN(quantity) && quantity > 0) {
          inventory[index].stock += quantity;
          showNotification(`${quantity} added to ${item.category}`);
          loadInventory();
          updateChart();
        } else {
          alert('Enter a valid quantity!');
        }
      });
      actionCell.appendChild(addButton);

      row.appendChild(categoryCell);
      row.appendChild(quantityCell);
      row.appendChild(actionCell);

      addStockTable.appendChild(row);
    });
  }

  function reduceStock(index) {
    if (inventory[index].stock > 0) {
      inventory[index].stock -= 1;
      if (inventory[index].stock <= inventory[index].criticalLevel) {
        showNotification(`${inventory[index].category} stock is below critical level!`);
      }
      loadInventory();
      updateChart();
    } else {
      showNotification(`${inventory[index].category} is out of stock!`);
    }
  }

  function showNotification(message) {
    notification.textContent = message;
    notification.style.display = 'block';

    setTimeout(() => {
      notification.style.display = 'none';
    }, 5000);
  }

  document.getElementById('simulateCartButton').addEventListener('click', () => {
    reduceStock(0); 
  });

  loadSalesData();
  loadInventory();
});

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="script.js"></script>
