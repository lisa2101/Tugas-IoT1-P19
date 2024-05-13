<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoT Devices Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS */
        .device-card {
            cursor: pointer;
        }
        .log-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Devices Panel -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Devices</h5>
                        <div id="devices-list"></div>
                    </div>
                </div>
            </div>
            <!-- Dashboard Panel -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Device Logs</h5>
                        <div class="row" id="logs-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to fetch all devices from API
        async function fetchDevices() {
            const response = await fetch('/api/devices');
            const devices = await response.json();
            const devicesList = document.getElementById('devices-list');
            devices.forEach(device => {
                const deviceCard = document.createElement('div');
                deviceCard.classList.add('card', 'mb-2');
                deviceCard.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${device.name}</h5>
                        <p class="card-text">ID: ${device.id}</p>
                    </div>
                `;
                deviceCard.addEventListener('click', () => {
                    fetchLogs(device.id);
                });
                devicesList.appendChild(deviceCard);
            });
        }

        // Function to fetch logs of a specific device from API
        async function fetchLogs(deviceId) {
            const response = await fetch(`/api/logs/${deviceId}`);
            const logs = await response.json();
            const logsContainer = document.getElementById('logs-container');
            logsContainer.innerHTML = ''; // Clear logs container
            logs.forEach(log => {
                const logItem = `
                    <div class="col-md-4">
                        <div class="card log-item">
                            <div class="card-body">
                                <h5 class="card-title">Time: ${log.time}</h5>
                                <p class="card-text">Data: ${log.data}</p>
                            </div>
                        </div>
                    </div>
                `;
                logsContainer.innerHTML += logItem;
            });
        }

        // Call fetchDevices function when page loads
        window.onload = function() {
            fetchDevices();
        };
    </script>
</body>
</html>
