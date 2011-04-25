<h1><?php echo $file; ?></h1>

<h2>Classes</h2>

<ul><?php foreach($file->getClasses() as $class): ?>

	<li><?php echo $class; ?></li>

<?php endforeach ?></ul>

<h2>Source</h2>

<pre><?php echo htmlentities($file->getSource()); ?></pre>