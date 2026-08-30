<div class="page-content header-clear-medium">

<div class="card card-style mt-n0" style="border-radius: 20px;border: 10px solid red;">
    <div class="content mb-3 mt-3">
      
        <div class="row text-center mb-0">
            
      
        <?php
$api_url = 'https://app.unitedapi.ng/wp-json/v1/api/realtime-network';
$api_key = '5LJwmRtjOdeTYR0uxAbotWEfzrUZhEax';

$post_data = array(
    'network' => '4'
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Token ' . $api_key,
    'Content-Type: application/json',
));

$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

curl_close($ch);
if ($response) { 
    $response = json_decode($response, true);
    displayNetworkStats($response['response']);
} else {
    echo "Failed to get API response.";
}

function displayNetworkStats($networkData) {
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';

    foreach ($networkData as $network => $value) {
        $colorClass = getColorClass($value);

        echo '<div class="container mt-3">
            <h4>' . $network . '</h4>
            <div class="progress">
                <div class="progress-bar ' . $colorClass . '" role="progressbar" style="width: ' . $value . '%" aria-valuenow="' . $value . '" aria-valuemin="0" aria-valuemax="100">' . $value . '%</div>
            </div>
        </div>';
    }
}

function getColorClass($value) {
    if ($value >= 65) {
        return 'bg-success';
    } elseif ($value >= 31) {
        return 'bg-warning';
    } else {
        return 'bg-danger';
    }
}
?>