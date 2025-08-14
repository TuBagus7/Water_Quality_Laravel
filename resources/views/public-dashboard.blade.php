<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard IoT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: linear-gradient(135deg, #f0f2f5, #dfe6e9); color: #333; }
        .container { padding: 40px; max-width: 1200px; margin: auto; }
        .header-text { text-align: center; font-size: 28px; margin-bottom: 20px; }
        #status { font-size: 14px; padding: 5px 10px; border-radius: 6px; background-color: #ffcccc; }
        .connected { background-color: #c8e6c9; }

        /* Card */
        .card-wrapper { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px; justify-content: center; }
        .card {
            flex: 1 1 calc(20% - 20px);
            min-width: 180px;
            padding: 20px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 6px 18px rgba(0,0,0,0.15); }
        .icon { font-size: 30px; margin-bottom: 10px; }
        .card h3 { font-size: 18px; margin-bottom: 8px; }
        .card p { font-size: 16px; color: #555; }

        /* Table */
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th { background-color: #f8f9fa; font-weight: bold; }
        .online { color: green; font-weight: bold; }
        .offline { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <main>
        <section>
            <div class="container">
                <h1 class="header-text">
                    Dashboard IoT <span id="status">Terputus</span>
                </h1>

                <!-- Cards with Icons -->
                <div class="card-wrapper">
                    <div class="card">
                        <div class="icon">🌡️</div>
                        <h3>Suhu Air</h3>
                        <p><span id="suhu">?</span> °C</p>
                    </div>
                    <div class="card">
                        <div class="icon">💧</div>
                        <h3>pH Air</h3>
                        <p><span id="ph">?</span></p>
                    </div>
                    <div class="card">
                        <div class="icon">🌫️</div>
                        <h3>Kekeruhan Air</h3>
                        <p><span id="tbdy">?</span></p>
                    </div>
                    <div class="card">
                        <div class="icon">📊</div>
                        <h3>Persentase</h3>
                        <p><span id="percent">?</span>%</p>
                    </div>
                    <div class="card">
                        <div class="icon">🧪</div>
                        <h3>Kualitas Air</h3>
                        <p><span id="quality">?</span></p>
                    </div>
                </div>

                <!-- Device Table -->
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Perangkat</th>
                                <th>Status Perangkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devices as $device)
                            <tr>
                                <td>{{ $device->serial_number }}</td>
                                <td>
                                    <p class="offline" id="status-{{ $device->serial_number }}">Offline</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        const host = 'wss://skripsi.cloud.shiftr.io:443';
        const clientId = Math.random().toString(16).substr(2, 8);

        const options = {
            keepalive: 30,
            clientId: clientId,
            username: 'skripsi',
            password: 'skripsimusto',
            protocolId: 'MQTT',
            protocolVersion: 4,
            clean: true,
            reconnectPeriod: 1000,
            connectTimeout: 30 * 1000
        };

        const client = mqtt.connect(host, options);

        client.on('connect', () => {
            console.log('Berhasil Terhubung ke Broker MQTT');
            document.getElementById('status').innerHTML = 'Terhubung';
            console.log(clientId);
            client.subscribe("musto/#", {qos: 1});
        });

        client.on('message', (topic, message) => {
            if(topic == "musto/suhu"){
                document.getElementById('suhu').innerHTML = message;
                console.log(topic, message);
            }

            if(topic == "musto/ph"){
                document.getElementById('ph').innerHTML = message;
                console.log(topic, message);
            }

            if(topic == "musto/tbdy"){
                //document.getElementById('inputServo').value = message;
                document.getElementById('tbdy').innerHTML = message + '°';
            }

            if(topic == "musto/percent"){
                document.getElementById('percent').innerHTML = message;
            }

            if(topic == "musto/quality"){
                document.getElementById('quality').innerHTML = message;
            }

            if(topic == "musto/status/123456789"){
                document.getElementById('status-123456789').innerHTML = message;
                
                if(message == "Online"){
                    document.getElementById('status-123456789').classList.remove('offline');
                    document.getElementById('status-123456789').classList.add('online');
                } else {
                    document.getElementById('status-123456789').classList.add('offline');
                    document.getElementById('status-123456789').classList.remove('online');
                }
            }
        });

        // const inputServo = document.getElementById('inputServo');
        // const valueServo = document.getElementById('valueServo');

        // inputServo.addEventListener('input', () => {
        //     valueServo.textContent = inputServo.value + '°';
        // });

        // const inputLcd = document.getElementById('inputLcd');
        // const submitBtn = document.getElementById('btnLcd');

        // submitBtn.addEventListener('click', () => {
        //     // alert(inputLcd.value);
        //     client.publish('musto/lcd', inputLcd.value, {qos: 1, retain: true});
        // });

        // function publishServo() {
        //     client.publish('musto/servo', inputServo.value, {qos: 1, retain: true});
        // }
    </script>
</body>
</html>