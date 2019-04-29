================
jQuery Photo Tag
================

This is my fork of the jQuery Photo Tag library. I am using this library on the project that I'm working on right now. Main reason of this fork is to add some little methods/events that I needed on my project.

Changes:
--------

* 'afterTagRequest' method is added. This method is called after the initialization of the tag request for an image (i.e. preparing the image structure for tagging).

        $('.photoTag').photoTag({
	    	requesTagstUrl: "some_url",
	    	deleteTagsUrl: "some_url",
	    	addTagUrl: "some_url",
	    
	    	afterTagRequest: function(parameters, image) {
			// do stuff
	    	}
	    });