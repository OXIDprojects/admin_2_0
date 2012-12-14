<!DOCTYPE html>
<html id="home" lang="de">
    <head>
        <meta charset="utf-8" />
        <title>Admin 2 / </title>
        <link rel="stylesheet" type="text/css" media="screen" href="views/src/css/reset.css">
        <link rel="stylesheet" type="text/css" media="screen" href="views/src/css/style.css">

        <!-- jquery UI Theme-->
        <link rel="stylesheet" type="text/css" media="screen" href="views/src/css/smoothness/jquery-ui-1.8.18.custom.css">

        <!-- Fluid CSS -->
        <link rel="stylesheet" type="text/css" media="screen" href="views/src/css/fluid_grid.css">
        <script src="views/src/js/modernizr.custom.js"></script>
    </head>
    <body>
        <header id="oxhead">
            <div class="oxidinfo">
                <a href="http://www.oxid-esales.com/" title="Visit OXID eSales Website" target="_blank">
					<img src="views/src/img/oxid_logo.jpg" alt="OXID eShop - Logo" />
				</a>
                <div class="oxidversion">Community Edition 4.5.8_42471</div>
            </div>
            <nav id="main">
				<p class="title">Artikelverwaltung</p>
                <ul>
                    <li class="favorites">
                        <a href="#" class="hassub">Favorites</a>
                        <ul>
                            <li><a href="#">Show Orders</a></li>
                            <li><a href="#">Add Order</a></li>
                        </ul>
                    </li>
                    <li class="help"><a href="#">Help</a></li>
                    <li class="logout"><a href="#">Logout</a></li>
                </ul>
            </nav>
        
        </header>
        
        <div id="main" role="main">
            <aside>
                <nav>
                    <ul>
                        <li class="orders">
                            <a href="#" class="active">Orders</a>
                            <ul>
                                <li class="grouptitle">Orders</li>
                                <li class="active"><a href="#">Orders</a></li>
                                <li><a href="#">Add Order</a></li>
                            </ul>
                        </li>
                        <li class="products">
                            <a href="#">Products</a>
                            <ul>
                                <li class="grouptitle">Products</li>
								<li><a href="#">Edit products</a></li>
                                <li><a href="#">Edit categories</a></li>
                            </ul>
                        </li>
                        <li class="marketing">
                            <a href="#">Marketing</a>
                            <ul>
                                <li class="grouptitle">Marketing</li>
								<li><a href="#">Newsletter</a></li>
                                <li><a href="#">Actionlists</a></li>
                            </ul>
                        </li>
                        <li class="user">
                            <a href="#">Usermanegement</a>
                            <ul>
                                <li class="grouptitle">Usermanagement</li>
								<li><a href="#">Edit users</a></li>
                                <li><a href="#">Edit usergroups</a></li>
                            </ul>
                        </li>
                        <li class="settings">
                            <a href="#">Settings</a>
                            <ul>
                                <li class="grouptitle">Settings</li>
								<li><a href="#">Coresettings</a></li>
                                <li><a href="#">Themes</a></li>
                                <li><a href="#">Modules</a></li>
                                <li><a href="#">Languages</a></li>
                                <li><a href="#">Currencies</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </aside>
            <div id="content">
				<div id="listfilter">
					Listfilter
				</div>
				<div id="addnew">
					<a class="btn addnew">Neuer Artikel<span>+</span></a>
				</div>
				<div id="quickeditlist">
				
					<section id="product_1" class="listentry active">
						<header>
							<h2>Ein Produkt</h2>
							<span class="price">195,99 €</span>
							<form>
								<input type="checkbox" name="active" id="active" value="1"><label for="active">Active</label>
							</form>
							<form>
								<select name="lang">
									<option value="1">english</option>
									<option value="0">german</option>
								</select>
							</form>
							<ul class="edit">
								<li>
									<a href="#" class="preview" target="preview">Preview</a>
								</li>
								<li>
									<a href="#" class="edit">Edit</a>
								</li>
								<li>
									<a href="#" class="delete">Delete</a>
								</li>
							</ul>
							<div class="clear"></div>
						</header>
						<section class="quickedit">
							<form>
                                <fieldset>
                                    <label class="main" for="ox_title">Title:</label>
                                    <input class="broad" name="ox_title" value="Ein Produkt" />
                                </fieldset>
                                <fieldset>
                                    <label class="main" for="ox_title">Price:</label>
                                    <input name="ox_title" value="Ein Produkt" />
                                    <span class="addinfo">Alt. Price</span>
                                    <label for="ox_title">A:</label>
                                    <input class="small" name="ox_title" value="" />
                                    <label for="ox_title">B:</label>
                                    <input class="small" name="ox_title" value="" />
                                    <label for="ox_title">C:</label>
                                    <input class="small" name="ox_title" value="" />
                                </fieldset>
                                <fieldset>
                                    <label class="main" for="ox_title">Normal field:</label>
                                    <input name="ox_title" value="Some value" />
                                </fieldset>
                                <fieldset class="last">
                                    <input name="submit" value="Sichern" type="submit" />
                                </fieldset>
							</form>
						</section>
					</section>
                    
                    <section id="product_1" class="listentry active outoftime">
						<header>
							<h2>Ein Produkt</h2>
							<span class="price">195,99 €</span>
							<form>
								<input type="checkbox" name="active" id="active" value="1"><label for="active">Active</label>
							</form>
							<form>
								<select name="lang">
									<option value="1">english</option>
									<option value="0">german</option>
								</select>
							</form>
							<ul class="edit">
								<li>
									<a href="#" class="preview" target="preview">Preview</a>
								</li>
								<li>
									<a href="#" class="edit">Edit</a>
								</li>
								<li>
									<a href="#" class="delete">Delete</a>
								</li>
							</ul>
							<div class="clear"></div>
						</header>
						<section class="quickedit">
							<form>
							<fieldset>
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
							</fieldset>
							<fieldset>
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
							</fieldset>
							<fieldset class="last">
								<input name="submit" value="Sichern" type="submit" />
							</fieldset>
							</form>
						</section>
					</section>
                    
                    <section id="product_1" class="listentry inactive">
						<header>
							<h2>Ein Produkt</h2>
							<span class="price">195,99 €</span>
							<form>
								<input type="checkbox" name="active" id="active" value="1"><label for="active">Active</label>
							</form>
							<form>
								<select name="lang">
									<option value="1">english</option>
									<option value="0">german</option>
								</select>
							</form>
							<ul class="edit">
								<li>
									<a href="#" class="preview" target="preview">Preview</a>
								</li>
								<li>
									<a href="#" class="edit">Edit</a>
								</li>
								<li>
									<a href="#" class="delete">Delete</a>
								</li>
							</ul>
							<div class="clear"></div>
						</header>
						<section class="quickedit">
							<form>
							<fieldset>
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
							</fieldset>
							<fieldset>
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
								<label for="ox_title">Title:</label>
								<input name="ox_title" value="Ein Produkt" />
							</fieldset>
							<fieldset class="last">
								<input name="submit" value="Sichern" type="submit" />
							</fieldset>
							</form>
						</section>
					</section>
					
				</div>
				<div id="quickeditadditional">
					<div id="dashboard">
                        <section class="listentry">
                            <header>
                                <h1>Dashboard</h1>
                            </header>
                            <section class="content">
                                <h1>To Do:</h1>
                                <ul>
                                    <li>
                                        Add product
                                    </li>
                                    <li>
                                        Sell product
                                    </li>
                                    <li>
                                        Ship order
                                    </li>
                                    <li>
                                        Pay your developer
                                    </li>
                                    <li>
                                        See you in Hawaii
                                    </li>
                                </ul>
                            </section>
                        </section>
					</div>
				</div>
				<div class="clear"></div>
            </div>
        </div>
        <script src="views/src/js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="views/src/js/joscha.js" type="text/javascript"></script>
        
    </body>
</html>

