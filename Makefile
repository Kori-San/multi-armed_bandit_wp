SRC_FOLDER = multi-armed_bandit_wp
ZIP_FILE = MULTI-ARMED_BANDIT_WP

all: zip

zip: 
	zip -r $(ZIP_FILE) $(SRC_FOLDER)

up:
	docker-compose up -d

down:
	docker-compose stop