CREATE TABLE IF NOT EXISTS meta_tags (
  page VARCHAR(255) PRIMARY KEY,
  meta_title VARCHAR(255) NOT NULL,
  meta_description TEXT NOT NULL
);