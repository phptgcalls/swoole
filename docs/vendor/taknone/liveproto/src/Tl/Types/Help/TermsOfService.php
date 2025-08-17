<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson id string text Vector<MessageEntity> entities true popup int min_age_confirm
 * @return help.TermsOfService
 */

final class TermsOfService extends Instance {
	public function request(object $id,string $text,array $entities,? true $popup = null,? int $min_age_confirm = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x780a0310);
		$flags = 0;
		$flags |= is_null($popup) ? 0 : (1 << 0);
		$flags |= is_null($min_age_confirm) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($id->read());
		$writer->tgwriteBytes($text);
		$writer->tgwriteVector($entities,'MessageEntity');
		if(is_null($min_age_confirm) === false):
			$writer->writeInt($min_age_confirm);
		endif;
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
		$result['id'] = $reader->tgreadObject();
		$result['text'] = $reader->tgreadBytes();
		$result['entities'] = $reader->tgreadVector('MessageEntity');
		if($flags & (1 << 1)):
			$result['min_age_confirm'] = $reader->readInt();
		else:
			$result['min_age_confirm'] = null;
		endif;
		return new self($result);
	}
}

?>