<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=login" />
    <title>Dashboard IoT</title>
    <style>
    *   {
            margin: 5px;
            padding:0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f2f5, #d9dde3);
            color: #333;
        }

        .container {
            padding: 40px;
            max-width: 1200px;
            margin: auto;
        }

        .header-text {
            text-align: center;
            font-size: 28px;
        }

        #status {
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            background-color: #ffcccc;
        }

        .connected {
            background-color: #c8e6c9;
        }
        /* Card */
        .card-wrapper { 
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 30px;  
            justify-content: center; 
        }
        .card-suhu {
            flex: 1 1 calc(20% - 20px);
            min-width: 180px;
            padding: 20px;
            border-radius: 12px;
            /* background: white; */
            background: linear-gradient(135deg, #FFD3A5, #FD6585);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-ph {
            flex: 1 1 calc(20% - 20px);
            min-width: 180px;
            padding: 20px;
            border-radius: 12px;
            /* background: white; */
            background: linear-gradient(135deg, #89f7fe, #66a6ff);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-tbdy {
            flex: 1 1 calc(20% - 20px);
            min-width: 180px;
            padding: 20px;
            border-radius: 12px;
            /* background: white; */
            background: radial-gradient(circle, #e3c995, #a88445);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-percent {
            flex: 1 1 calc(20% - 20px);
            min-width: 180px;
            padding: 20px;
            border-radius: 12px;
            /* background: white; */
            background: radial-gradient(circle, #a8cff9 0%, #a58fe9 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-quality {
            flex: 1 1 calc(20% - 20px);
            min-width: 180px;
            padding: 20px;
            border-radius: 12px;
            /* background: white; */
            background: linear-gradient(135deg, #a8e6cf 0%, #56b892 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-suhu:hover, .card-ph:hover,.card-tbdy:hover,.card-percent:hover,.card-quality:hover { transform: translateY(-5px); box-shadow: 0 6px 18px rgba(0,0,0,0.15); }
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
        
            <div class="container-title">
                <h1 class="header-text text-3xl font-bold ">Musto Monitoring Air Quality 
                    <p style="float:right" ><a href="{{route('login')}}"><span class="material-symbols-outlined">
                        login
                    </span>
                    </p>
                    <br>
                    <span id="status">Terputus</span>
                </h1>
            </div>
            

                <!-- Cards with Icons -->
                <div class="card-wrapper">
                    <div class="card-suhu">
                        <div class="icon">🌡️</div>
                        <h3>Suhu Air</h3>
                        <p><span id="suhu">?</span> °C</p>
                    </div>
                    <div class="card-ph">
                        <div class="icon">💧</div>
                        <h3>pH Air</h3>
                        <p><span id="ph">?</span></p>
                    </div>
                    <div class="card-tbdy">
                        <div class="icon">🌫️</div>
                        <h3>Kekeruhan Air</h3>
                        <p><span id="tbdy">?</span></p>
                    </div>
                    <div class="card-percent">
                        <div class="icon">📊</div>
                        <h3>Persentase</h3>
                        <p><span id="percent">?</span>%</p>
                    </div>
                    <div class="card-quality">
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
    /* Daftar broker MQTT
        //const host = "wss://skripsi.cloud.shiftr.io:443";
        // const host = "wss://test.mosquitto.org:8081/mqtt";
    */
        const host = "wss://broker.emqx.io:8084/mqtt";
        const clientId = "webclient-" + Math.random().toString(16).substr(2, 8);

        const options = {
            keepalive: 30,
            clientId: clientId,
            // username: 'skripsi',
            // password: 'skripsimusto',
            // protocolId: 'MQTT',
            // protocolVersion: 4,
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
            if(topic == "musto/monitoring"){
                try {
                    //Parsing (parse) JSON: Mengubah pesan teks dari MQTT menjadi data yang bisa di baca 
                    const data = JSON.parse(message.toString());
                    // Update UI elements with data from JSON
                    if(data.suhu !== undefined) document.getElementById('suhu').innerHTML = data.suhu;
                    if(data.ph !== undefined) document.getElementById('ph').innerHTML = data.ph;
                    if(data.tbdy !== undefined) document.getElementById('tbdy').innerHTML = data.tbdy; // Removed + '°' as it might not be needed or added elsewhere, keeping consistent with original logic if possible, but user request implied just data. Original code had + '°' for tbdy. Let's keep it safe.
                    // Actually, original code for tbdy had + '°'. Let's add it back if it's a number.
                    if(data.tbdy !== undefined) document.getElementById('tbdy').innerHTML = data.tbdy + '°';

                    if(data.bobot !== undefined) document.getElementById('percent').innerHTML = data.bobot;
                    if(data.quality !== undefined) document.getElementById('quality').innerHTML = data.quality;
                    
                    if(data.status !== undefined) {
                        document.getElementById('status-123456789').innerHTML = data.status;
                        if(data.status == "Online"){
                            document.getElementById('status-123456789').classList.remove('offline');
                            document.getElementById('status-123456789').classList.add('online');
                        } else {
                            document.getElementById('status-123456789').classList.remove('online');
                            document.getElementById('status-123456789').classList.add('offline');
                        }
                    }

                    console.log("JSON Data received:", data);
                } catch (e) {
                    console.error("Error parsing JSON:", e);
                }
            }
        });
    </script>
</body>
</html>