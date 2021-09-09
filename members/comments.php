<?php isLoggedIn(); ?>

<div class="row mr-1 rounded-lg">

    <div class="media p-3 border rounded-lg">
        <img src="img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:50px;">

        <div class="media-body">
            <a href="" class="text-decoration-none">
                <h5 class="mt-0">Sam</h5>
            </a>
            <p>Standing on the frontline when the bombs start to fall. Heaven is jealous of our love, angels are crying from up above. Can't replace you with a million rings. Boy, when you're with me I'll give you a taste. There’s no going back. Before you met me I was alright but things were kinda heavy. Heavy is the head that wears the crown.</p>

            <?php for ($i = 0; $i < 3; $i++) : ?>
                <div class="media mt-3">
                    <a class="mr-3" href="#">
                        <img src="..." alt="...">
                    </a>
                    <div class="media-body">
                        <a href="">
                            <h5 class="mt-0">Jason</h5>
                        </a>
                        <p>Greetings loved ones let's take a journey. Yes, we make angels cry, raining down on earth from up above. Give you something good to celebrate. I used to bite my tongue and hold my breath. I'm ma get your heart racing in my skin-tight jeans. As I march alone to a different beat. Summer after high school when we first met. You're so hypnotizing, could you be the devil? Could you be an angel? It's time to bring out the big balloons. Thought that I was the exception. Bikinis, zucchinis, Martinis, no weenies.</p>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

    </div>

</div>