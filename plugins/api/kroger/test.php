<?php 
include_once("../../config.php");

$api = new Kroger();
$token = "eyJhbGciOiJSUzI1NiIsImprdSI6Imh0dHBzOi8vYXBpLWNlLmtyb2dlci5jb20vdjEvLndlbGwta25vd24vandrcy5qc29uIiwia2lkIjoidnl6bG52Y3dSUUZyRzZkWDBzU1pEQT09IiwidHlwIjoiSldUIn0.eyJhdWQiOiJwcmljZXBhbHNob3BwaW5nLWIwZGQ2Zjk4Y2M4ZjVlMmRkNDZhOTlhNmE2MGQ0NTA3MjEwMjg4NTgxOTI0ODYzODI4NyIsImV4cCI6MTcwMTk5MDA5OCwiaWF0IjoxNzAxOTg4MjkzLCJpc3MiOiJhcGktY2Uua3JvZ2VyLmNvbSIsInN1YiI6IjY4OTkwMDBlLTUzMjgtNWJlYy1hY2U4LWZkYzg5ZjFlNWQ3YSIsInNjb3BlIjoiIiwiYXV0aEF0IjoxNzAxOTg4Mjk4NjcwNTgwODQwLCJhenAiOiJwcmljZXBhbHNob3BwaW5nLWIwZGQ2Zjk4Y2M4ZjVlMmRkNDZhOTlhNmE2MGQ0NTA3MjEwMjg4NTgxOTI0ODYzODI4NyJ9.ay-eXnaCRNiE8lgJ189JNZ0m5oUqqYLU5YDEP581r9JRsfLNxK8vuV2oQ92KJ40NIZYe2qUCUh624b5sX-LZTGW5WkD1HBwloC0Pbsuyf9TXus9-RzxW7RAhDxWyRGlvAR2QXSfg65T8I2250wMmxzSGOowvQkyFflw1a9FgBjWvCz90aar8HGJaa_hHRq7y1KaPPDV3PnI_l53XvMhNS-SahB4_banOqKTatOgyI_vg-kn6pEiRCBdAvDsmwS-2iasDsbXYvYfKPgXi25IEA1cb4jLCZMnVU3Y94xZGOozk6iRJHJeGHj_4voIPZT38FnfuB21QQ8JuTXUBGPpUwg";
$json = $api->callApi($api->getToken(),"Eggs");
echo print_r(json_decode($json),true);
?>