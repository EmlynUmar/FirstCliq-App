<div class="page-content header-clear-medium bg-light card">
    
<div class="text-center p-3"><a class="btn btn-primary btn-sm" href="/mobile/home/pricing">Pricing And Plan ID</a> 
<a class="btn btn-primary btn-sm" href="/mobile/home/profile"> Copy API Key Here</a></div>

<div class="container">
        <div class="endpoint">
            <h2>Check Balance</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/user/</code></p>
            <p>Method: GET</p>
            <pre><code>
curl --location 'https://dataflex.ng/@@2700/user/' \
--header 'Authorization: Token your-api-key-here' \
--header 'Content-Type: application/json'
            </code></pre>
     <div class="res">Expected Response</div>
  "name": "benazdata Musa", <br>
  "balance": "11,521.09", <br>
  "status": "success"
       </div>
        <hr>

        <div class="endpoint">
            <h2>Airtime</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/airtime/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'http://dataflex.ng/@@2700/airtime/' \
--header 'Authorization: Token 12345' \
--header 'Content-Type: application/json' \
--data '{
    "network":"1",
    "phone":"08147180780",
    "ref":"9876543210",
    "airtime_type":"VTU",
    "ported_number":false,
    "amount":"200"
}'
            </code></pre>
    
        </div>
<hr>
        <div class="endpoint">
            <h2>Data</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/data/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'https://dataflex.ng/@@2700/data/' \
--header 'Token: Token 12345' \
--header 'Content-Type: application/json' \
--data '{
    "network":"1",
    "phone":"08147180780",
    "ref":"9876543210",
    "data_plan":"1",
    "ported_number":false
}'
            </code></pre>
        </div>
<hr>
        <div class="endpoint">
            <h2>Verify Cable</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/cabletv/verify/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'https://dataflex.ng/@@2700/cabletv/verify/' \
--header 'Token: Token 1234' \
--data '{
    "provider":"1", 
    "iucnumber":"73737267672"
}'
            </code></pre>
        </div>
<hr>
        <div class="endpoint">
            <h2>Cable</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/cabletv/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'https://dataflex.ng/@@2700/cabletv/' \
--header 'Token: Token 1234' \
--data '{
    "provider":"1", 
    "iucnumber":"73737267672",
    "plan":"3",
    "ref":"9876543210",
    "subtype":"renew/change",
    "phone":"08147180780"
}'
            </code></pre>
        </div>
<hr>
        <div class="endpoint">
            <h2>Verify Electricity</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/electricity/verify/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'https://dataflex.ng/@@2700/electricity/verify/' \
--header 'Token: Token 1234' \
--data '{
    "provider":"1", 
    "meternumber":"24567665767",
    "metertype":"prepaid/postpaid"
    
}'
            </code></pre>
        </div>
<hr>
        <div class="endpoint">
            <h2>Electricity</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/electricity/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'https://dataflex.ng/@@2700/electricity/' \
--header 'Token: Token 1234' \
--data '{
    "provider":"1", 
    "meternumber":"24567665767",
    "amount":"1000",
    "metertype":"prepaid/postpaid",
    "phone":"07032529431",
    "ref":"2eertt567ye678"
}'
            </code></pre>
        </div>
<hr>
        <div class="endpoint">
            <h2>Exam Pin</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/exam/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'https://dataflex.ng/@@2700/exam/' \
--header 'Token: Token 1234' \
--data '{
    "provider":"1", 
    "quantity":"2",
    "ref":"2eertt567ye678"
}'
            </code></pre>
        </div>
<hr>
        <div class="endpoint">
            <h2>Data Pin</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/datapin/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'https://dataflex.ng/@@2700/datapin/' \
--header 'Token: Token 1234' \
--data '
  "network": "1",
  "quantity": "1",
  "data_plan": "1",
  "businessname" "businessname",
  "ref" "9876543210",
}'
            </code></pre>
        </div>
        
        <hr>
        <div class="endpoint">
            <h2>Recharge Card Pin</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/recharge-pin/</code></p>
            <p>Method: GET</p>
            <pre><code>curl --location 'https://dataflex.ng/@@2700/recharge-pin/' \
--header 'Token: Token 1234' \
--data '
  "network": "1",
  "quantity": "1",
  "amount": "100",
  "businessname" "businessname",
  "ref" "9876543210",
}'
            </code></pre>
        </div>
        <hr>
        <div class="endpoint">
            <h2>Send BulkSmS</h2>
            <p>Endpoint: <code>https://dataflex.ng/@@2700/bulks/</code></p>
            <p>Method: GET</p>
            <pre><code>
curl --location 'https://dataflex.ng/@@2700/bulksms/' \
--header 'Authorization: Token your-api-key-here' \
--header 'Content-Type: application/json
--data
   "sender": "benazdata",
   "messege": "Hello, How are you"
   "phonenumber": "09029163515",
            </code></pre>
        </div>
        <hr><br>
        <div></div>
    </div>
    </div>
</body>
</html>