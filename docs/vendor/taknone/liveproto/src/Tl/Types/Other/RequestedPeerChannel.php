<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id string title string username photo photo
 * @return RequestedPeer
 */

final class RequestedPeerChannel extends Instance {
	public function request(int $channel_id,? string $title = null,? string $username = null,? object $photo = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ba403e4);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($username) ? 0 : (1 << 1);
		$flags |= is_null($photo) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($username) === false):
			$writer->tgwriteBytes($username);
		endif;
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['channel_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['username'] = $reader->tgreadBytes();
		else:
			$result['username'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		return new self($result);
	}
}

?>