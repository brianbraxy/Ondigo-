<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module">
        import NFCReader from '@digitalbazaar/nfc';

        const nfcReader = new NFCReader();

        nfcReader.onreading = (event) => {
            // Handle NFC card data here
            console.log('NFC Card Data:', event.message.records);
        };

        nfcReader.onerror = (error) => {
            // Handle errors here
            console.error('NFC Error:', error);
        };

        async function startNFC() {
            try {
                await nfcReader.scan();
                console.log('NFC reader started');
            } catch (error) {
                console.error('Error starting NFC reader:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            startNFC();
        });
    </script>
</head>
<body>
    <!-- Your HTML content goes here -->
</body>
</html>
