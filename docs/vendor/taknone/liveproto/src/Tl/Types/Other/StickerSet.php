<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash string title string short_name int count int hash true archived true official true masks true emojis true text_color true channel_emoji_status true creator int installed_date Vector<PhotoSize> thumbs int thumb_dc_id int thumb_version long thumb_document_id
 * @return StickerSet
 */

final class StickerSet extends Instance {
	public function request(int $id,int $access_hash,string $title,string $short_name,int $count,int $hash,? true $archived = null,? true $official = null,? true $masks = null,? true $emojis = null,? true $text_color = null,? true $channel_emoji_status = null,? true $creator = null,? int $installed_date = null,? array $thumbs = null,? int $thumb_dc_id = null,? int $thumb_version = null,? int $thumb_document_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2dd14edc);
		$flags = 0;
		$flags |= is_null($archived) ? 0 : (1 << 1);
		$flags |= is_null($official) ? 0 : (1 << 2);
		$flags |= is_null($masks) ? 0 : (1 << 3);
		$flags |= is_null($emojis) ? 0 : (1 << 7);
		$flags |= is_null($text_color) ? 0 : (1 << 9);
		$flags |= is_null($channel_emoji_status) ? 0 : (1 << 10);
		$flags |= is_null($creator) ? 0 : (1 << 11);
		$flags |= is_null($installed_date) ? 0 : (1 << 0);
		$flags |= is_null($thumbs) ? 0 : (1 << 4);
		$flags |= is_null($thumb_dc_id) ? 0 : (1 << 4);
		$flags |= is_null($thumb_version) ? 0 : (1 << 4);
		$flags |= is_null($thumb_document_id) ? 0 : (1 << 8);
		$writer->writeInt($flags);
		if(is_null($installed_date) === false):
			$writer->writeInt($installed_date);
		endif;
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($short_name);
		if(is_null($thumbs) === false):
			$writer->tgwriteVector($thumbs,'PhotoSize');
		endif;
		if(is_null($thumb_dc_id) === false):
			$writer->writeInt($thumb_dc_id);
		endif;
		if(is_null($thumb_version) === false):
			$writer->writeInt($thumb_version);
		endif;
		if(is_null($thumb_document_id) === false):
			$writer->writeLong($thumb_document_id);
		endif;
		$writer->writeInt($count);
		$writer->writeInt($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['archived'] = true;
		else:
			$result['archived'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['official'] = true;
		else:
			$result['official'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['masks'] = true;
		else:
			$result['masks'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['emojis'] = true;
		else:
			$result['emojis'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['text_color'] = true;
		else:
			$result['text_color'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['channel_emoji_status'] = true;
		else:
			$result['channel_emoji_status'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['creator'] = true;
		else:
			$result['creator'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['installed_date'] = $reader->readInt();
		else:
			$result['installed_date'] = null;
		endif;
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		$result['short_name'] = $reader->tgreadBytes();
		if($flags & (1 << 4)):
			$result['thumbs'] = $reader->tgreadVector('PhotoSize');
		else:
			$result['thumbs'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['thumb_dc_id'] = $reader->readInt();
		else:
			$result['thumb_dc_id'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['thumb_version'] = $reader->readInt();
		else:
			$result['thumb_version'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['thumb_document_id'] = $reader->readLong();
		else:
			$result['thumb_document_id'] = null;
		endif;
		$result['count'] = $reader->readInt();
		$result['hash'] = $reader->readInt();
		return new self($result);
	}
}

?>