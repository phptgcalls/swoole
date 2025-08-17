<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securevaluetype type true native_names true selfie_required true translation_required
 * @return SecureRequiredType
 */

final class SecureRequiredType extends Instance {
	public function request(object $type,? true $native_names = null,? true $selfie_required = null,? true $translation_required = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x829d99da);
		$flags = 0;
		$flags |= is_null($native_names) ? 0 : (1 << 0);
		$flags |= is_null($selfie_required) ? 0 : (1 << 1);
		$flags |= is_null($translation_required) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($type->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['native_names'] = true;
		else:
			$result['native_names'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['selfie_required'] = true;
		else:
			$result['selfie_required'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['translation_required'] = true;
		else:
			$result['translation_required'] = false;
		endif;
		$result['type'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>