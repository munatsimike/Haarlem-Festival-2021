   <?php
   echo " <script>
            function showAlert(msg, alertType)
            {
                notif({
                    msg: msg,
                    type: alertType,
                    position: 'center',
                    timeout: 6000,
                    width: 600,
                    height: 60
                });
            }
    </script>";