<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputmedia media long random_id string message Vector<MessageEntity> entities
 * @return InputSingleMedia
 */

final class InputSingleMedia extends Instance {
	public function request(object $media,int $random_id,string $message,? array $entities = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1cc6e91f);
		$flags = 0;
		$flags |= is_null($entities) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($media->read());
		$writer->writeLong($random_id);
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['media'] = $reader->tgreadObject();
		$result['random_id'] = $reader->readLong();
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		return new self($result);
	}
}

?>