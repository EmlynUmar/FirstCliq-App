$domains = @("agdatasub.com", "www.agdatasub.com", "al-hayatdata.com.ng", "tcrwrtsr.agdatasub.com")
foreach ($d in $domains) {
    $clean = $d -replace "www\.", "" -replace "https://", "" -replace "http://", ""
    $b64 = [Convert]::ToBase64String([System.Text.Encoding]::UTF8.GetBytes($clean))
    $md5 = [System.Security.Cryptography.MD5]::Create()
    $hashBytes = $md5.ComputeHash([System.Text.Encoding]::UTF8.GetBytes($b64))
    $hashString = ($hashBytes | ForEach-Object { $_.ToString("x2") }) -join ""
    Write-Host "$d -> clean: $clean -> hash: $hashString"
}
