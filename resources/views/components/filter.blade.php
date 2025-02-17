<div class="filter">
  <h2>Filter by:</h2>
  <label for="title">Title:</label>
  <input type="text" id="title" name="title" oninput="filterMovies(this.value)">
  
  <label for="genre">Genre:</label>
  <select id="genre" name="genre" onchange="filterMovies(this.value)">
    <option value="">All</option>
    <option value="Action">Action</option>
    <option value="Comedy">Comedy</option>
    <option value="Drama">Drama</option>
  </select>
  
  <label for="rating">Rating:</label>
  <select id="rating" name="rating" onchange="filterMovies(this.value)">
    <option value="">All</option>
    <option value="1">1+</option>
    <option value="2">2+</option>
    <option value="3">3+</option>
    <option value="4">4+</option>
    <option value="5">5+</option>
  </select>
</div>