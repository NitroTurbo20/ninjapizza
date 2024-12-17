
document.addEventListener('DOMContentLoaded', () => {
  const salesData = [
    { product: 'Dough', sold: 120 },
    { product: 'Cheese', sold: 95 },
    { product: 'Tomato Sauce', sold: 110 },
    { product: 'Pepperoni', sold: 150 },
    { product: 'Vegetables', sold: 75 }
  ];

  const salesTable = document.getElementById('salesTable').querySelector('tbody');
  const salesChartCanvas = document.getElementById('salesChart');
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
              label: context => '${context.raw} units'
            }
          }
        }
      }
    });
  }

  
  document.getElementById('simulateCartButton').addEventListener('click', () => {
    salesData[0].sold += 5; 
    loadSalesData();
  });

  loadSalesData();
});
document.addEventListener('DOMContentLoaded', () => {
 
  const inventory = [
    { category: 'Dough', stock: 50, criticalLevel: 10 },
    { category: 'Cheese', stock: 30, criticalLevel: 5 },
    { category: 'Tomato Sauce', stock: 40, criticalLevel: 8 },
    { category: 'Pepperoni', stock: 25, criticalLevel: 5 },
    { category: 'Vegetables', stock: 20, criticalLevel: 5 }
  ];

  const inventoryTable = document.getElementById('inventoryTable').querySelector('tbody');
  const addStockTable = document.getElementById('addStockTable').querySelector('tbody');
  const notification = document.getElementById('notification');

  
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
          showNotification('${quantity} added to ${item.category}');
          loadInventory();
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
        showNotification('${inventory[index].category} stock is below critical level!');
      }
      loadInventory();
    } else {
      showNotification('${inventory[index].category} is out of stock!');
    }
  }


  document.getElementById('simulateCartButton').addEventListener('click', () => {
    reduceStock(0); 
  });

  
  function showNotification(message) {
    notification.textContent = message;
    notification.style.display = 'block';

    setTimeout(() => {
      notification.style.display = 'none';
    }, 5000);
  }


  loadInventory();
});



