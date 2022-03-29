<?php
session_start();

    require ("../src/functions.php");
    require ("../src/database.php");

    $user_data = checkLogin($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Proposal Management</title>
    <link rel="stylesheet" href="css/sidebar_header.css">
    <link rel="stylesheet" href="css/supervisor_project_proposal_management.css">
    <script type="text/javascript" src="js/sidebar.js"></script>
</head>
<body>
    <header class="header">
        <img class="menu-icon" src="../src/icon/menu_128px.png" alt="menu icon" title="Menu">
        <div class="welcome-msg">
            Welcome, <?php echo $user_data['NAME']?>.
        </div>
    </header>
    <div class="container">
        <div class="sidebar">
            <div class="middle-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <a href="dashboard.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/project_proposal_management_128px.png" alt="project proposal management icon" title="Project Proposal Management"></a>
                    </li>
                    <li>
                        <a href="project_planning.php"><img class="sidebar-item" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="student-to-project_assignment.php"><img class="sidebar-item" src="../src/icon/student-to-project_assignment_128px.png" alt="student-to-project assignment icon" title="Student-To-Project Assignment"></a>
                    </li>
                    <li>
                        <a href="meeting_management.php"><img class="sidebar-item" src="../src/icon/meeting_management_128px.png" alt="meeting management icon" title="Meeting Management"></a>
                    </li>
                </ul>
            </div>
            <div class="bottom-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <a href="editProfile.php"><img class="sidebar-item" src="../src/icon/edit_profile_128px.png" alt="edit profile icon" title="Edit Profile"></a>
                    </li>
                    <li>
                        <a href="../src/logout.php"><img class="sidebar-item" src="../src/icon/logout_128px.png" alt="logout icon" title="Logout"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="proposal-management-box">
                <h1>Welcome to Project Proposal Management</h1>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex rem ipsum porro delectus ipsa placeat modi aut non blanditiis, consequatur earum provident atque quaerat. Sint veniam facere minima nostrum exercitationem sit iste placeat iure non officia adipisci porro similique dolorum vero temporibus corrupti, incidunt, fugit recusandae. Eos voluptas ipsam reprehenderit fugit ad obcaecati ipsum ratione officiis ipsa. Voluptas nam modi, commodi rerum repellendus quae amet, illum expedita esse quis officiis impedit cumque deserunt ipsum asperiores corrupti nulla repudiandae atque mollitia soluta sit ea? A ratione voluptatem sapiente excepturi possimus, ad, atque repellat iusto, architecto iste commodi ut? Cupiditate aliquid quae ad quaerat maxime, ut recusandae perferendis tempore itaque reiciendis fugiat, odio ea vero non illo voluptatibus laborum! Dolore molestias ab hic? Dolorem, eveniet dolores non at voluptatum laudantium recusandae sapiente reprehenderit soluta maxime provident vero vel maiores aperiam ullam eum necessitatibus quibusdam? Corrupti necessitatibus corporis et, dolore reiciendis dolorum dolor earum recusandae incidunt optio nostrum accusantium? Dignissimos et modi adipisci illo labore rerum! Sed libero doloremque repellendus quaerat iste veniam, error adipisci sint porro exercitationem obcaecati eum, perspiciatis illo aliquam enim debitis assumenda reiciendis architecto repudiandae sequi velit! Quos ad enim sapiente autem incidunt debitis. Quaerat nam praesentium, beatae iste vel consectetur doloremque laboriosam asperiores hic nobis assumenda laudantium amet illum, repellat facere enim sequi reprehenderit at et! Expedita blanditiis nulla vitae corporis pariatur eius tenetur fuga, natus cumque autem similique soluta voluptate excepturi esse dolores deleniti ducimus illo exercitationem! Suscipit perferendis debitis ad reiciendis nesciunt, maxime magni labore fugiat soluta perspiciatis commodi, veniam illo nihil magnam exercitationem at, itaque consectetur unde modi accusantium similique. Cum fugit maiores enim, tempora culpa aliquam accusamus debitis consequuntur libero, sed voluptate distinctio voluptatum impedit praesentium incidunt? Placeat laboriosam sunt tenetur quod beatae eum unde error eos repellat! Eaque eius rerum porro dolore, cupiditate quisquam vel. Ipsam, quos accusantium incidunt fugit explicabo minus aliquid sed ullam sapiente, quo facilis dolorem excepturi sunt nam corporis, amet perferendis repellat eum reprehenderit! Autem cum alias veritatis consequuntur harum aspernatur culpa, aliquid voluptas natus in repellendus at rem tenetur praesentium dolores, et minima. Doloribus reprehenderit fugiat dolores tempora repudiandae id officiis aperiam, a quaerat alias corrupti praesentium totam in obcaecati aspernatur aliquid odio velit quo necessitatibus, maiores veritatis quidem nisi recusandae! Accusantium non dolorem natus eaque dicta sed impedit esse sit obcaecati laudantium dolore magni, excepturi cum amet perspiciatis! Dolor cumque excepturi voluptas tenetur! Accusamus, officia amet unde eos sit est sapiente neque nobis quos rerum accusantium, debitis quisquam obcaecati? Sit provident sint dolore ipsum voluptas modi aut eligendi quibusdam natus est ex quasi culpa, iste iure enim quisquam vero dicta aspernatur. Placeat harum dolores sapiente porro ut. Iusto, dolores earum sed perferendis, illum aliquam est necessitatibus, nesciunt laborum sunt exercitationem nostrum blanditiis neque suscipit ipsam? Quas ea dicta nihil, natus necessitatibus blanditiis praesentium iure consequuntur voluptatem perferendis, neque iusto commodi officia minima ipsa eligendi tempora laborum tenetur, quaerat atque fugit accusantium minus impedit. Quaerat impedit officiis odit aliquam animi, magni delectus eius sunt fuga. Ipsa doloremque doloribus eveniet iusto velit quod repellat tenetur consequatur aliquid sapiente beatae voluptates quaerat fugit ratione odio sint, adipisci earum obcaecati quisquam. Ratione similique tempora cumque eos ducimus sunt veritatis eius distinctio maxime rerum aut voluptatibus temporibus, eum cum ex neque sint non facere, eligendi officia. Consequuntur reprehenderit, ipsa ex quod necessitatibus ratione nemo illo doloremque saepe perferendis cupiditate praesentium consectetur provident totam inventore exercitationem, dolorem accusantium debitis voluptates amet sunt odit. At reprehenderit illum, sed fuga a cupiditate amet dolorem, non eos nobis eaque recusandae facere saepe esse. Magnam incidunt, eveniet ipsa et, ea assumenda in repudiandae omnis itaque voluptatum quibusdam atque, reprehenderit totam quis saepe quod obcaecati cumque ratione perferendis eaque corporis doloremque! Sed maiores iure aliquam unde similique amet eveniet sapiente cupiditate, deserunt quia repudiandae, voluptates numquam ipsa cumque perspiciatis facilis tempora! Esse consectetur modi libero incidunt tenetur, nisi voluptas quasi ratione eligendi nostrum itaque, excepturi veritatis delectus. Vero dolorum optio accusantium, quaerat aut iure beatae explicabo quas amet dolores cupiditate eveniet magni facere, vel consectetur repudiandae nesciunt voluptates consequatur ad facilis distinctio neque blanditiis illum unde! Est sit consectetur delectus quos labore! Eius expedita hic repellendus. Reprehenderit suscipit fugit cum id vero, consequatur expedita sint quae sit, pariatur aspernatur harum cupiditate debitis tempora magnam quod praesentium autem asperiores. Modi, architecto. Non nostrum sint porro minus itaque neque quas. Minus nihil enim eveniet. Obcaecati error provident id, temporibus molestiae consequuntur cumque odit, consectetur ducimus dolor illum vel illo numquam nam minima quisquam minus debitis eius fuga. Illo culpa id assumenda ipsam? Nemo accusantium quibusdam fugiat adipisci expedita nostrum iste eum quas, animi sequi quaerat sint aspernatur tenetur maiores saepe quidem? Ab reprehenderit cum quae quidem ullam repellendus vel aliquid ipsam veritatis quaerat. Repellendus, recusandae adipisci aperiam est dolorum quos, obcaecati repudiandae optio esse nemo eveniet id accusantium maxime architecto. Praesentium corporis architecto, pariatur fugit quam ducimus exercitationem a sit et cupiditate facere est eum ipsa ut illo. Corrupti eum id quo quisquam. Sequi eaque veniam quam fuga error explicabo, distinctio beatae quasi doloribus consequuntur maxime. Libero inventore labore in obcaecati doloribus voluptas facilis cumque atque voluptatem magnam ex tempore, necessitatibus corporis, velit ut modi eligendi, qui explicabo eaque sit cum illum. Ipsum delectus numquam quisquam adipisci velit ad laboriosam cum ab. Saepe at perspiciatis ratione nostrum ipsam voluptas incidunt inventore libero dolores blanditiis nemo, eos esse earum neque recusandae? Ab quidem temporibus similique commodi asperiores tempore reprehenderit accusamus. Reiciendis suscipit ullam alias sint impedit labore laudantium vel. Ratione, sequi quam? Adipisci quidem doloribus dignissimos omnis ad optio ex, numquam aperiam aut rerum, sequi dolorum natus tempora quis? Assumenda corrupti reprehenderit rerum aut eos numquam optio unde necessitatibus omnis perferendis iusto, perspiciatis quis eaque possimus asperiores veniam placeat temporibus eveniet ratione minima pariatur sequi! Neque doloremque sunt dolor repudiandae, similique asperiores. Totam, ipsum cupiditate! Facere quidem aliquid illum magni deleniti at et necessitatibus tempora. Suscipit iusto, odit alias distinctio aspernatur voluptates, eveniet, ipsam ducimus nam harum ad iste? Molestias odit distinctio aspernatur odio obcaecati perferendis maxime, excepturi et explicabo sed?
            </div>
        </div>
    </div>
</body>
</html>