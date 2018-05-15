<?php foreach ($qry as $r) {
            ?>
            <div>
                <center>
                    <p>Kindly contact the trader for purchasing this item</p>
                    <table>
                        <tr>
                            <td>Name</td>
                            <td width='15px'>:</td>
                            <td><?php echo $r->fullName ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $r->email ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td>:</td>
                            <td><?php echo $r->contactNumber ?></td>
                        </tr>
                    </table>
                </center>
            </div>
            <?php
        } ?>