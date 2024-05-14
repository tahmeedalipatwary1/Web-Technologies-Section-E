<?php
session_start();
require_once('../Models/db.php');
require_once('../Models/all_course_db.php');
$conn=getConnection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recommendedCourses = [];

if (isset($_POST['query'])) {
    $query = mysqli_real_escape_string($conn, $_POST['query']);
    $sql = "SELECT id, title, description, category, videoURL, price FROM courses WHERE title LIKE '%$query%'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $recommendedCourses[] = $row;
        }
    } else {
        echo '<p>No matching courses found.</p>';
    }
}
$conn->close();
?>

<?php if (!empty($recommendedCourses)): ?>
    <h3>Recommended Courses</h3>
    <?php foreach ($recommendedCourses as $course): ?>
        <?php $videoID = getYouTubeVideoID($course['videoURL']); ?>
        <div class="course">
            <div class="course-thumbnail">
                <?php if ($videoID): ?>
                    <img src="https://img.youtube.com/vi/<?php echo $videoID; ?>/hqdefault.jpg" alt="<?php echo htmlspecialchars($course['title']); ?>" style="width:100px;height:100px;">
                <?php else: ?>
                    <img src="path_to_default_thumbnail_image" alt="Default Thumbnail" style="width:100px;height:100px;">
                <?php endif; ?>
            </div>
            <div class="course-info">
                <h4><?php echo htmlspecialchars($course['title']); ?></h4>
                <p><?php echo htmlspecialchars($course['description']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>