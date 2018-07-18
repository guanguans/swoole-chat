echo "restart service..."
pid=`pidof guanguans_master`
echo $pid
kill -USR1 $pid
echo "restart service success"