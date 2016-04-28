<section class="collab" id="collab">

	<div class="wrap indent">
		<div class="inner">
			<p>We are always looking for new talented people.</p>
			<p>Want to collab? Send us a <a class="link" data-target="page/collab">note</a>.</p>

			<form id="collab_form" action="<?php echo $site->url() ?>/assets/collab_post.php" method="post" data-abide="ajax">
				<div class="name-field">
					<label>
						<input type="text" name="name" maxlength="50" placeholder="Name" pattern="[a-zA-Z0-9\s]+" required>
					</label>
					<small class="error">Please, tell us your name.</small>
				</div>
				<div class="email-field">
					<label>
						<input type="email" name="email" maxlength="50" placeholder="Email" required>
					</label>
					<small class="error">That's not a valid e-mail.</small>
				</div>
				<div class="website-field">
					<label>
						<input type="text" name="website" maxlength="100" placeholder="Website">
					</label>
				</div>
				<!-- <div class="pdf-field">
					<input type="checkbox" name="pdf" id="pdf" value="yes" class="css-checkbox"/><label for="pdf" class="css-label">Ask for our full portfolio</label>
				</div> -->
				<div class="message-field">
					<label>
						<textarea type="text" name="message" maxlength="1000" placeholder="Message" pattern="[a-zA-Z0-9\s]+" rows="6" wrap="soft" required></textarea>
					</label>
					<small class="error">You forgot your note :)</small>
				</div>

				<input class="submitLink h1 bold" name="formSubmit" type="submit" value="Send"></button>
			</form>
		</div>
		<div id="result"></div>

	</div>

</section>