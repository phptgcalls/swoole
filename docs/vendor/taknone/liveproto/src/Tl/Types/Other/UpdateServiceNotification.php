<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type string message messagemedia media Vector<MessageEntity> entities true popup true invert_media int inbox_date
 * @return Update
 */

final class UpdateServiceNotification extends Instance {
	public function request(string $type,string $message,object $media,array $entities,? true $popup = null,? true $invert_media = null,? int $inbox_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xebe46819);
		$flags = 0;
		$flags |= is_null($popup) ? 0 : (1 << 0);
		$flags |= is_null($invert_media) ? 0 : (1 << 2);
		$flags |= is_null($inbox_date) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($inbox_date) === false):
			$writer->writeInt($inbox_date);
		endif;
		$writer->tgwriteBytes($type);
		$writer->tgwriteBytes($message);
		$writer->write($media->read());
		$writer->tgwriteVector($entities,'MessageEntity');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['popup'] = true;
		else:
			$result['popup'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['invert_media'] = true;
		else:
			$result['invert_media'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['inbox_date'] = $reader->readInt();
		else:
			$result['inbox_date'] = null;
		endif;
		$result['type'] = $reader->tgreadBytes();
		$result['message'] = $reader->tgreadBytes();
		$result['media'] = $reader->tgreadObject();
		$result['entities'] = $reader->tgreadVector('MessageEntity');
		return new self($result);
	}
}

?>