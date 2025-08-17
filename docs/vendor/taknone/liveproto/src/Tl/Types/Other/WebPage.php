<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string url string display_url int hash true has_large_media true video_cover_photo string type string site_name string title string description photo photo string embed_url string embed_type int embed_width int embed_height int duration string author document document page cached_page Vector<WebPageAttribute> attributes
 * @return WebPage
 */

final class WebPage extends Instance {
	public function request(int $id,string $url,string $display_url,int $hash,? true $has_large_media = null,? true $video_cover_photo = null,? string $type = null,? string $site_name = null,? string $title = null,? string $description = null,? object $photo = null,? string $embed_url = null,? string $embed_type = null,? int $embed_width = null,? int $embed_height = null,? int $duration = null,? string $author = null,? object $document = null,? object $cached_page = null,? array $attributes = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe89c45b2);
		$flags = 0;
		$flags |= is_null($has_large_media) ? 0 : (1 << 13);
		$flags |= is_null($video_cover_photo) ? 0 : (1 << 14);
		$flags |= is_null($type) ? 0 : (1 << 0);
		$flags |= is_null($site_name) ? 0 : (1 << 1);
		$flags |= is_null($title) ? 0 : (1 << 2);
		$flags |= is_null($description) ? 0 : (1 << 3);
		$flags |= is_null($photo) ? 0 : (1 << 4);
		$flags |= is_null($embed_url) ? 0 : (1 << 5);
		$flags |= is_null($embed_type) ? 0 : (1 << 5);
		$flags |= is_null($embed_width) ? 0 : (1 << 6);
		$flags |= is_null($embed_height) ? 0 : (1 << 6);
		$flags |= is_null($duration) ? 0 : (1 << 7);
		$flags |= is_null($author) ? 0 : (1 << 8);
		$flags |= is_null($document) ? 0 : (1 << 9);
		$flags |= is_null($cached_page) ? 0 : (1 << 10);
		$flags |= is_null($attributes) ? 0 : (1 << 12);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->tgwriteBytes($url);
		$writer->tgwriteBytes($display_url);
		$writer->writeInt($hash);
		if(is_null($type) === false):
			$writer->tgwriteBytes($type);
		endif;
		if(is_null($site_name) === false):
			$writer->tgwriteBytes($site_name);
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($description) === false):
			$writer->tgwriteBytes($description);
		endif;
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		if(is_null($embed_url) === false):
			$writer->tgwriteBytes($embed_url);
		endif;
		if(is_null($embed_type) === false):
			$writer->tgwriteBytes($embed_type);
		endif;
		if(is_null($embed_width) === false):
			$writer->writeInt($embed_width);
		endif;
		if(is_null($embed_height) === false):
			$writer->writeInt($embed_height);
		endif;
		if(is_null($duration) === false):
			$writer->writeInt($duration);
		endif;
		if(is_null($author) === false):
			$writer->tgwriteBytes($author);
		endif;
		if(is_null($document) === false):
			$writer->write($document->read());
		endif;
		if(is_null($cached_page) === false):
			$writer->write($cached_page->read());
		endif;
		if(is_null($attributes) === false):
			$writer->tgwriteVector($attributes,'WebPageAttribute');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 13)):
			$result['has_large_media'] = true;
		else:
			$result['has_large_media'] = false;
		endif;
		if($flags & (1 << 14)):
			$result['video_cover_photo'] = true;
		else:
			$result['video_cover_photo'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['url'] = $reader->tgreadBytes();
		$result['display_url'] = $reader->tgreadBytes();
		$result['hash'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['type'] = $reader->tgreadBytes();
		else:
			$result['type'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['site_name'] = $reader->tgreadBytes();
		else:
			$result['site_name'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['description'] = $reader->tgreadBytes();
		else:
			$result['description'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['embed_url'] = $reader->tgreadBytes();
		else:
			$result['embed_url'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['embed_type'] = $reader->tgreadBytes();
		else:
			$result['embed_type'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['embed_width'] = $reader->readInt();
		else:
			$result['embed_width'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['embed_height'] = $reader->readInt();
		else:
			$result['embed_height'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['duration'] = $reader->readInt();
		else:
			$result['duration'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['author'] = $reader->tgreadBytes();
		else:
			$result['author'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['document'] = $reader->tgreadObject();
		else:
			$result['document'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['cached_page'] = $reader->tgreadObject();
		else:
			$result['cached_page'] = null;
		endif;
		if($flags & (1 << 12)):
			$result['attributes'] = $reader->tgreadVector('WebPageAttribute');
		else:
			$result['attributes'] = null;
		endif;
		return new self($result);
	}
}

?>