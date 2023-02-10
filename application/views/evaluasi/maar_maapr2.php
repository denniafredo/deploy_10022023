<html>
    <head>
        <title></title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>    
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/orgchart/getorgchart.js"></script>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/orgchart/css/getorgchart.css" />
        <script type="text/javascript">
            var orgchart = new getOrgChart(document.getElementById("people"),{			
                color: "blue",
                dataSource: [
                    { id: 1, parentId: null, Name: "Amber McKenzie"},
                    { id: 2, parentId: 1, Name: "Ava Field"},
                    { id: 3, parentId: 1, Name: "Evie Johnson"}]
            });
        </scipt>
    </head>
    <body>
        <div id="people"></div>
    </body>
</html>

