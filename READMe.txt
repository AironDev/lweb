Learn Javasript, JSON and JQuery from the University of Mechigan, offered through Coursera



<?php foreach ($oldPositions as  $position): ?>
                        <div id="<?php echo "position".$position['position_id']; ?>" >                              
                            <input type="text" name="<?php echo "year".$position['position_id']; ?>" value="<?php echo $position['year'] ?>" class="form-control col-sm-8 float-left" placeholder="Year">
                            <button id="" onclick=" return false" class="form-control col-sm-2 float-right">-</button>
                            <textarea name="<?php echo "desc".$position['position_id']; ?>" cols="80" rows="5" class="form-control" placeholder="Description"><?php echo $position['description'] ?></textarea>
                        </div>
                        <?php endforeach; ?>




This snippet shows add if positions is less than 9
<?php if($num < 9): ?>
                            <label class="label-for-position">Position</label>
                            <button id="addPos" onclick="return false">+</button>
                            <div id="position_fields">
                            <!-- position fiels are injected here from jquery -->
                            </div>
                             <hr/>
                        <?php endif ?>