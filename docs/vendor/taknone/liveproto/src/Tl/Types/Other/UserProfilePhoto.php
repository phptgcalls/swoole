<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long photo_id int dc_id true has_video true personal bytes stripped_thumb
 * @return UserProfilePhoto
 */

final class UserProfilePhoto extends Instance {
	public function request(int $photo_id,int $dc_id,? true $has_video = null,? true $personal = null,? string $stripped_thumb = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x82d1f706);
		$flags = 0;
		$flags |= is_null($has_video) ? 0 : (1 << 0);
		$flags |= is_null($personal) ? 0 : (1 << 2);
		$flags |= is_null($stripped_thumb) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($photo_id);
		if(is_null($stripped_thumb) === false):
			$writer->tgwriteBytes($stripped_thumb);
		endif;
		$writer->writeInt($dc_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['has_video'] = true;
		else:
			$result['has_video'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['personal'] = true;
		else:
			$result['personal'] = false;
		endif;
		$result['photo_id'] = $reader->readLong();
		if($flags & (1 << 1)):
			$result['stripped_thumb'] = $reader->tgreadBytes();
		else:
			$result['stripped_thumb'] = null;
		endif;
		$result['dc_id'] = $reader->readInt();
		return new self($result);
	}
}

?>