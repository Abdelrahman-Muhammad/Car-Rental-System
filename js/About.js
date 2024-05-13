document.addEventListener("DOMContentLoaded", function() {
    // Load cars automatically when page loads
    var xhr = new XMLHttpRequest();
    xhr.open('POST', document.querySelector('form').dataset.ajaxUrl, true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById('results').innerHTML = xhr.responseText;
      } else {
        console.error('Error:', xhr.statusText);
      }
    };
    xhr.send();
  });
  
document.getElementById('applyFilters').addEventListener('click', function(event) {
    event.preventDefault(); // prevent form submission
    var formData = new FormData(document.querySelector('form'));
    var xhr = new XMLHttpRequest();
    xhr.open('POST', document.querySelector('form').dataset.ajaxUrl, true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById('results').innerHTML = xhr.responseText;
      } else {
        console.error('Error:', xhr.statusText);
      }
    };
    xhr.send(formData);
});

function openPopup(carId, model, year, color, transmission, price, horsepower, location, branch) {
    const popup = document.createElement("div");
    popup.innerHTML = `
    <div class="mx-auto p-4 bg-white rounded ">
      <button class="absolute top-0 right-0 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" style="font-size: 18px; margin-left: 5px;">
        <i class="fas fa-times"></i>
      </button>
      <h2 class="text-2xl font-bold pb-3">Reserve Car ${carId}</h2>
      <div class="grid grid-cols-1 gap-4">
        <div class="bg-[#d2ffd5] text-green-900 shadow-md rounded p-4">
          <h3 class="text-lg font-bold">Car Information</h3>
          <p>Car ID: ${carId}</p>
          <p>Model: ${model}</p>
          <p>Year: ${year}</p>
          <p>Color: ${color}</p>
          <p>Transmission: ${transmission}</p>
          <p>Price: ${price}</p>
          <p>Horsepower: ${horsepower}</p>
          <p>Location: ${location}</p>
          <p>Branch: ${branch}</p>
        </div>
        <div class="bg-white shadow-md rounded p-4">
          <h3 class="text-lg font-bold">Reserve Car</h3>
          <form id="reservationForm">
          <input type="hidden" name="carId" value="${carId}" >
          <input type="hidden" name="total_price" id="totalPriceInput" >
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Pickup Time
            </span>
            <input type="date" name="pickup_time" id="pickupTime" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" required>
          </label>
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Return Time
            </span>
            <input type="date" name="return_time" id="returnTime" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" required>
          </label>
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Is Paid
            </span>
            <input type="checkbox" name="is_paid" id="isPaid" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full h-12 rounded-md accent-green-500">
          </label>
          <div class="items-right text-right">
            <button type="submit" class="mt-2 bg-green-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Reserve Car
            </button>
            <p id="totalPrice"></p>
          </div>
        </form>
        </div>
      </div>
    </div>
  `;
  
  document.body.appendChild(popup);
  popup.style.position = "fixed";
  popup.style.width = "75%";
  popup.style.top = "50%";
  popup.style.left = "50%";
  popup.style.transform = "translate(-50%, -50%)";
  popup.style.background = "white";
  popup.style.padding = "10px";
  popup.style.border = "1px solid #ddd";
  popup.style.borderRadius = "10px";
  popup.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.2)";
  
  const form = popup.querySelector("form");
  
  
  form.addEventListener("submit", (e) => {
    e.preventDefault();
  
    const pickupTime = new Date(pickupTimeInput.value);
    const returnTime = new Date(returnTimeInput.value);
  
    if (pickupTime >= returnTime) {
      alert("Pickup time must be earlier than return time.");
      return;
    }
  
    const formData = new FormData(form);
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/reserve_car.php", true);
    xhr.send(formData);
    xhr.onload = function() {
      if (xhr.status === 200) {
        alert(xhr.responseText);
        popup.remove();
      } else {
        alert("Error: " + xhr.statusText);
      }
    };
  });
  
  const closeButton = popup.querySelector("button");
  closeButton.addEventListener("click", () => {
    popup.remove();
    
  })

  const pickupTimeInput = popup.querySelector("#pickupTime");
  const returnTimeInput = popup.querySelector("#returnTime");
  const totalPriceDisplay = popup.querySelector("#totalPrice");
  
  const updateTotalPrice = () => {
    const pickupTime = new Date(pickupTimeInput.value);
    const returnTime = new Date(returnTimeInput.value);
    const isPaid = document.getElementById("isPaid").checked;
  
    const millisecondsPerDay = 24 * 60 * 60 * 1000;
    let reservationDays = Math.ceil((returnTime - pickupTime) / millisecondsPerDay);
    reservationDays = Math.max(reservationDays, 0);
    const totalPrice = reservationDays * price;
  
    totalPriceDisplay.textContent = `Total Price: $${totalPrice}`;
    document.getElementById("totalPriceInput").value = totalPrice; // Update hidden input value
  };
  
  pickupTimeInput.addEventListener("change", updateTotalPrice);
  returnTimeInput.addEventListener("change", updateTotalPrice);
});
