ALTER TABLE destinations
DROP COLUMN image_url;
ALTER TABLE destinations
ADD COLUMN image BLOB;
