<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiant Media Player Example</title>

    <!-- Include Radiant Media Player JavaScript file -->
    <script src="https://cdn.radiantmediatechs.com/rmp/9.11.1/js/rmp.min.js"></script>
</head>
<body>

    <!-- Player container element -->
    <div id="rmp"></div>

    <!-- Set up player configuration options -->
    <script>
        // Your streaming source - HLS in this example
        const src = {
            hls: 'https://demo.unified-streaming.com/k8s/features/stable/video/tears-of-steel/tears-of-steel.ism/.m3u8'
        };

        // Your player settings
        const settings = {
            // licenseKey: 'your-license-key', // Uncomment and replace with your Radiant Media Player license key
            src: src,
            width: 640,
            height: 360,
            skin: 's1',
            contentMetadata: {
                poster: [
                    'https://your-poster-url.jpg'
                ]
            },
            // Colorization settings
            skinBackgroundColor: '01579B',
            skinButtonColor: 'FFD180',
            skinAccentColor: 'FF9100'
        };

        // Initialize Radiant Media Player
        const rmp = new RadiantMP('rmp');
        rmp.init(settings);
    </script>

</body>
</html>
