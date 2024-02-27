<div id="container">
    <div id="head">
        <img src="<?= config_item('base_url') ;?>assets/img/CONSULTARE LOGO.jpg" />
        <h1>Complaint Log Record</h1>
    </div>
    <div id="body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date-Time Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): foreach ($records as $record): ?>
                    <tr>
                        <td><?= $record['PK_id'] ?></td>
                        <td><?= date_format(date_create($record['created_at']),"F d, Y h:i:s A") ?></td>
                        <td>
                            <a href="<?php echo site_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/clr/details?id={$record['PK_id']}") ?>"><i class="fa fa-eye"></i></a> | 
                            <a><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>