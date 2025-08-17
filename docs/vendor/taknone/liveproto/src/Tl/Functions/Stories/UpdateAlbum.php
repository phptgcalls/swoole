<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int album_id string title Vector<int> delete_stories Vector<int> add_stories Vector<int> order
 * @return StoryAlbum
 */

final class UpdateAlbum extends Instance {
	public function request(object $peer,int $album_id,? string $title = null,? array $delete_stories = null,? array $add_stories = null,? array $order = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5e5259b6);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($delete_stories) ? 0 : (1 << 1);
		$flags |= is_null($add_stories) ? 0 : (1 << 2);
		$flags |= is_null($order) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($album_id);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($delete_stories) === false):
			$writer->tgwriteVector($delete_stories,'int');
		endif;
		if(is_null($add_stories) === false):
			$writer->tgwriteVector($add_stories,'int');
		endif;
		if(is_null($order) === false):
			$writer->tgwriteVector($order,'int');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>