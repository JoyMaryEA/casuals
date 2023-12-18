<div class="filter-container">  
        <form class="filters" action="<?php echo URL; ?>casuals/filter" method="POST">
            <select class="custom-select custom-select-lg mb-3" name="country">
                <option selected>Select Country</option>
                <option value="Kenya">Kenya</option>
                <option value="Uganda">Uganda</option>
                <option value="Malawi">Malawi</option>
              </select>
              <select class="custom-select custom-select-lg mb-3" name="program">
                <option selected>Select Program</option>
                <option value="DSW Program Casuals">DSW Program Casuals</option>
                <option value="Data Entry -DTW">Data Entry -DTW</option>
                <option value="NEEP">NEEP</option>
                <option value="Tumika">Tumika</option>
                <option value="GS Carbon">GS Carbon</option>
              </select>
              <input class="bt-filter" type="submit" name="submit_filter" value="Filter" />
            
        </form>
</div>