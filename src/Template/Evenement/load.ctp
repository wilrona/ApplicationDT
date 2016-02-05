<script type="application/javascript" src="/js/jquery.js"></script>

<span class="canvas" data-value="<?=$ratio ?>"
      data-size="220"
      data-fill="{
                                         &quot;gradient&quot;: [&quot;red&quot;, &quot;orange&quot;]
                                         }"
    >

    </span>

<script src="/js/circle-progress.js"></script>
<script>
    $('.canvas').circleProgress({
        startAngle: -1/2*Math.PI
    });
</script>

