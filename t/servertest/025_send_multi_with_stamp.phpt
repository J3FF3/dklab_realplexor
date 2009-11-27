--TEST--
dklab_realplexor: data with cursor to multi disconnected clients is buffered too

--FILE--
<?php
$VERBOSE = 1;
require dirname(__FILE__) . '/init.php';

send_in("identifier=12345.678:abc,def,hgi", "
	aaa
");

?>
--EXPECT--
# Starting.
#   [pairs_by_fhs=0 data_to_send=0 connected_fhs=0 online_timers=0 cleanup_timers=0 events=*]
# WAIT: listening 0.0.0.0:8088
#   [pairs_by_fhs=0 data_to_send=0 connected_fhs=0 online_timers=0 cleanup_timers=0 events=*]
# IN: listening 127.0.0.1:10010
#   [pairs_by_fhs=0 data_to_send=0 connected_fhs=0 online_timers=0 cleanup_timers=0 events=*]
# Switching current user to unprivileged "nobody"
#   [pairs_by_fhs=0 data_to_send=0 connected_fhs=0 online_timers=0 cleanup_timers=0 events=*]
IN <== X-Realplexor: identifier=12345.678:abc,def,hgi
IN <== 
IN <== "aaa"
# IN: DEBUG: connection opened
#   [pairs_by_fhs=0 data_to_send=0 connected_fhs=0 online_timers=0 cleanup_timers=0 events=*]
# IN: DEBUG: read <N> bytes
#   [pairs_by_fhs=0 data_to_send=0 connected_fhs=0 online_timers=0 cleanup_timers=0 events=*]
# IN: DEBUG: parsed IDs
#   [pairs_by_fhs=0 data_to_send=0 connected_fhs=0 online_timers=0 cleanup_timers=0 events=*]
# IN: DEBUG: adding data for [abc]
#   [pairs_by_fhs=0 data_to_send=0 connected_fhs=0 online_timers=0 cleanup_timers=0 events=*]
# IN: DEBUG: adding data for [def]
#   [pairs_by_fhs=0 data_to_send=1 connected_fhs=0 online_timers=0 cleanup_timers=1 events=*]
# IN: DEBUG: adding data for [hgi]
#   [pairs_by_fhs=0 data_to_send=2 connected_fhs=0 online_timers=0 cleanup_timers=2 events=*]
# IN: DEBUG: connection closed
#   [pairs_by_fhs=0 data_to_send=3 connected_fhs=0 online_timers=0 cleanup_timers=3 events=*]
IN ==>