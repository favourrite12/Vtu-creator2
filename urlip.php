<?php
function getAddresses($domain) {
  $records = dns_get_record($domain);
  $res = array();
  foreach ($records as $r) {
    if ($r['host'] != $domain) continue; // glue entry
    if (!isset($r['type'])) continue; // DNSSec

    if ($r['type'] == 'A') $res[] = $r['ip'];
    if ($r['type'] == 'AAAA') $res[] = $r['ipv6'];
  }
  return $res;
}

function getAddresses_www($domain) {
  $res = getAddresses($domain);
  if (count($res) == 0) {
    $res = getAddresses('www.' . $domain);
  }
  return $res;
}

?>