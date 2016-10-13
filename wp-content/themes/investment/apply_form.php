<?php
/* Template Name: Apply Form
*/
get_header();
?>
<form method="post" action="contact.php" enctype="multipart/form-data">
                    <div class="col-sm-8 col-sm-offset-4">
                        <div class="row">
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name *" required>
                            </div>
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="email" name="email" class="form-control" placeholder="Email *" required>
                            </div>
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="email" name="confirm_email" class="form-control" placeholder="Confirm Email *" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="text" name="cell_phone" class="form-control" placeholder="Cell Phone *" required>
                            </div>
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="text" name="work_phone" class="form-control" placeholder="Work Phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="text" name="addr_1" class="form-control" placeholder="Address 1*" required>
                            </div>
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="text" name="addr_2" class="form-control" placeholder="Address 2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 margin-bottom-15">
                                        <input type="text" name="city" class="form-control" placeholder="City">
                                    </div>
                                    <div class="col-sm-6 margin-bottom-15">
                                        <select name="state" class="form-control">
                                        	<option value="0" selected disabled>Select State</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="DC">District Of Columbia</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="text" name="zip" class="form-control" placeholder="Zip Code">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 margin-bottom-15">
                                <input type="text" name="refered_by" class="form-control" placeholder="Referred by *" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 margin-bottom-15">
                                Do you have any previous sales experience: *
                            </div>
                            <div class="col-sm-6 margin-bottom-15">
                                <label>
                                    <input type="radio" name="experience" value="yes" required> Yes
                                </label>
                                <label>
                                    <input type="radio" name="experience" value="no"> No
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 margin-bottom-15">
                                <textarea class="form-control" rows="5" name="brief_experience" placeholder="Brief description of sales history"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 margin-bottom-15">
                                Do you hold a Life Insurance License: *
                            </div>
                            <div class="col-sm-6 margin-bottom-15">
                                <label>
                                    <input type="radio" name="insurance_licence" value="yes" required> Yes
                                </label>
                                <label>
                                    <input type="radio" name="insurance_licence" value="no"> No
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 margin-bottom-15">
                                <textarea class="form-control" rows="5" name="value_to_company" placeholder="Why would you be a good fit for Equis Financial"></textarea>
                            </div>
                        </div>
                        <div class="row margin-bottom-30">
                            <div class="col-sm-6 margin-bottom-15">
                                Upload Resume (pdf,docx,doc and max. 2MB):
                            </div>
                            <div class="col-sm-6 margin-bottom-15">
                                <input type="file" name="resume">
                            </div>
                        </div>
                        <div class="row btn-container">
                            <div class="col-xs-6">
                                <button class="button btn-gray" type="reset">RESET</button>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button class="button" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php get_footer(); ?>
