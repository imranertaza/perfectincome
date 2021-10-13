<?php
print $sidebar_left;
?>
	<div class="col-md-8">
            <h1><?php print $page_title; ?></h1><hr />
            <div class="result_form">
            	<form method="post" action="<?php print base_url(); ?>result.html">
                <table>
                <thead>
                    <tr>
                        <th width="158">Year</th>
                        <th width="245">Class</th>
                        <th width="245">Group</th>
                        <th width="245">Exam</th>
                        <th width="245">Roll</th>
                        <th width="245"></th>
                    </tr>
                    <tr>
                        <th width="158">
                        <select name="year">
                            <option value="">Year</option>
                            <?php print get_year_list(2015, 2050); ?>
                        </select></th>
                        <th width="245">
                        <select name="class">
                        <option value="">Class</option>
                        <?php print class_list(); ?>
                        </select>
                        </th>
                        <th width="245">
                        <select name="group">
                        <option value="">Group</option>
                        <?php print group_list(); ?>
                        </select>
                        </th>
                        <th width="245">
                        <select name="exam">
                        <option value="">Exam</option>
                        <?php print exam_list(); ?>
                        </select>
                        </th>
                        <th width="245"><input type="text" name="roll" /></th>
                        <th width="245"><input type="submit" name="result_search" value="Search Result" /></th>
                    </tr>
                </thead>
                </table>
                </form>
            </div>
            <hr />
            <?php 
			print $msg;
			if (!empty($subject_result)) { ?>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th width="158">Subject</th>
                        <th width="245">Written/CQ</th>
                        <th width="245">MCQ</th>
                        <th width="245">Practical</th>
                        <th width="245">Total Marks</th>
                        <th width="245">Point</th>
                        <th width="245">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php print $subject_result; ?>
                    <tr>
                        <th width="158"></th>
                        <th width="158"></th>
                        <th width="158"></th>
                        <th width="158"></th>
                        <th width="245">Result</th>
                        <th width="245"><?php print $point_result; ?></th>
                        <th width="245"><?php print $grade_result; ?></th>
                    </tr>
                </tbody>
            </table>
            <?php } ?>
    </div>
    
    
<?php
print $sidebar_right;
?>