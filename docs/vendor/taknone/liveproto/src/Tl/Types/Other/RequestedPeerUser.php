<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id string first_name string last_name string username photo photo
 * @return RequestedPeer
 */

final class RequestedPeerUser extends Instance {
	public function request(int $user_id,? string $first_name = null,? string $last_name = null,? string $username = null,? object $photo = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd62ff46a);
		$flags = 0;
		$flags |= is_null($first_name) ? 0 : (1 << 0);
		$flags |= is_null($last_name) ? 0 : (1 << 0);
		$flags |= is_null($username) ? 0 : (1 << 1);
		$flags |= is_null($photo) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		if(is_null($first_name) === false):
			$writer->tgwriteBytes($first_name);
		endif;
		if(is_null($last_name) === false):
			$writer->tgwriteBytes($last_name);
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
		$result['user_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['first_name'] = $reader->tgreadBytes();
		else:
			$result['first_name'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['last_name'] = $reader->tgreadBytes();
		else:
			$result['last_name'] = null;
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