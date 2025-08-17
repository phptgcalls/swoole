<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string message true update_app Vector<MessageEntity> entities
 * @return help.DeepLinkInfo
 */

final class DeepLinkInfo extends Instance {
	public function request(string $message,? true $update_app = null,? array $entities = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6a4ee832);
		$flags = 0;
		$flags |= is_null($update_app) ? 0 : (1 << 0);
		$flags |= is_null($entities) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['update_app'] = true;
		else:
			$result['update_app'] = false;
		endif;
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		return new self($result);
	}
}

?>