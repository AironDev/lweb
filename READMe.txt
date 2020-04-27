Learn Javasript, JSON and JQuery from the University of Mechigan, offered through Coursera



<?php foreach ($oldPositions as  $position): ?>
                        <div id="<?php echo "position".$position['position_id']; ?>" >                              
                            <input type="text" name="<?php echo "year".$position['position_id']; ?>" value="<?php echo $position['year'] ?>" class="form-control col-sm-8 float-left" placeholder="Year">
                            <button id="" onclick=" return false" class="form-control col-sm-2 float-right">-</button>
                            <textarea name="<?php echo "desc".$position['position_id']; ?>" cols="80" rows="5" class="form-control" placeholder="Description"><?php echo $position['description'] ?></textarea>
                        </div>
                        <?php endforeach; ?>