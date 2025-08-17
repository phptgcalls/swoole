<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securevaluetype type securedata data inputsecurefile front_side inputsecurefile reverse_side inputsecurefile selfie Vector<InputSecureFile> translation Vector<InputSecureFile> files secureplaindata plain_data
 * @return InputSecureValue
 */

final class InputSecureValue extends Instance {
	public function request(object $type,? object $data = null,? object $front_side = null,? object $reverse_side = null,? object $selfie = null,? array $translation = null,? array $files = null,? object $plain_data = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdb21d0a7);
		$flags = 0;
		$flags |= is_null($data) ? 0 : (1 << 0);
		$flags |= is_null($front_side) ? 0 : (1 << 1);
		$flags |= is_null($reverse_side) ? 0 : (1 << 2);
		$flags |= is_null($selfie) ? 0 : (1 << 3);
		$flags |= is_null($translation) ? 0 : (1 << 6);
		$flags |= is_null($files) ? 0 : (1 << 4);
		$flags |= is_null($plain_data) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->write($type->read());
		if(is_null($data) === false):
			$writer->write($data->read());
		endif;
		if(is_null($front_side) === false):
			$writer->write($front_side->read());
		endif;
		if(is_null($reverse_side) === false):
			$writer->write($reverse_side->read());
		endif;
		if(is_null($selfie) === false):
			$writer->write($selfie->read());
		endif;
		if(is_null($translation) === false):
			$writer->tgwriteVector($translation,'InputSecureFile');
		endif;
		if(is_null($files) === false):
			$writer->tgwriteVector($files,'InputSecureFile');
		endif;
		if(is_null($plain_data) === false):
			$writer->write($plain_data->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['type'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['data'] = $reader->tgreadObject();
		else:
			$result['data'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['front_side'] = $reader->tgreadObject();
		else:
			$result['front_side'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['reverse_side'] = $reader->tgreadObject();
		else:
			$result['reverse_side'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['selfie'] = $reader->tgreadObject();
		else:
			$result['selfie'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['translation'] = $reader->tgreadVector('InputSecureFile');
		else:
			$result['translation'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['files'] = $reader->tgreadVector('InputSecureFile');
		else:
			$result['files'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['plain_data'] = $reader->tgreadObject();
		else:
			$result['plain_data'] = null;
		endif;
		return new self($result);
	}
}

?>